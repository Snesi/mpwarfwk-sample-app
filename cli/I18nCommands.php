<?php

namespace CLI;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class I18nCommands extends Command
{
    protected function configure()
    {
        $this
            ->setName('i18n:parse')
            ->setDescription('Parses Templates and extracts gettext texts')
            ->addArgument(
                'dir',
                InputArgument::REQUIRED,
                'Where is the templates dir?'
            )
            ->addOption(
                'eng',
                null,
                InputOption::VALUE_REQUIRED,
                'Template engine being used',
                'twig'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dir = $input->getArgument('dir');
        $eng = $input->getOption('eng');
        if ($eng === "twig") {
            $this->loadTwig($dir);
            $text = "Your Twig templates have successfully been converted to po files.";
        } else {
            $text = "Sorry $eng doesn't have i18n support yet.";
        }
        $output->writeln($text);
    }

    private function loadTwig($tplDir)
    {
        $tplDir = __DIR__.'/../src/views';
        $localesDir = __DIR__."/../src/locales";
        $tmpDir = "$tplDir/cache";
        $loader = new Twig_Loader_Filesystem($tplDir);

        // force auto-reload to always have the latest version of the template
        $twig = new Twig_Environment($loader, array(
            'cache' => $tmpDir,
            'auto_reload' => true,
        ));
        $twig->addExtension(new Twig_Extensions_Extension_I18n());
        // configure Twig the way you want

        // iterate over all your templates
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($tplDir), RecursiveIteratorIterator::LEAVES_ONLY) as $file) {
            // force compilation
            if ($file->isFile()) {
                $twig->loadTemplate(str_replace($tplDir.'/', '', $file));
            }
        }

        exec("xgettext --default-domain=messages -p $localesDir --from-code=UTF-8 -n --omit-header -L PHP $tmpDir");
    }

    private function loadSmarty()
    {
        // TODO: i18n support for Smarty, PS: Smarty sucks...
    }

}
