<?php

use \MPWAR\AppConfig;

// AppConfig is a key-value container for all custom configurations you need.
// Use: AppConfig::key(value);
// You can also chain calls.

AppConfig::debug(true)
    ->appName("MPWAR-TEST")
    ->locales(["es", "en"])
    ->defaultLocale("es");
