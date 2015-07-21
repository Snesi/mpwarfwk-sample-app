<?php

/* hello.twig */
class __TwigTemplate_85081e0df79d3126642c79a4626d19db06aeda9206fed5e10897c8b08dfe0b9c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
\t<title>Hello Page</title>
</head>
<body>
\t<div class=\"container\">
\t\t<div class=\"jumbotron\">
\t\t\t<h1>Hello ";
        // line 9
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo "!</h1>
\t\t\t<p>
\t\t\t\t";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["strings"]) ? $context["strings"] : null), "greeting", array()), (isset($context["locale"]) ? $context["locale"] : null), array(), "array"), "html", null, true);
        echo "
\t\t\t</p>
\t\t</div>
\t</div>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "hello.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 11,  29 => 9,  19 => 1,);
    }
}
