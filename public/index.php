<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';
// cela permet de surcharger nos variable d'environnement
$_SERVER['APP_RUNTIME_OPTIONS'] = [
    'dotenv_overload' => true,
];
return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};