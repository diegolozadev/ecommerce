<?php

/**
 * Depurar Errores
 */

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', "C:/xampp/htdocs/ecommerce/web/php_error_log");

/**
 * Require Controllers
 */

require_once 'controllers/template.controller.php';
require_once 'controllers/curl.controller.php';

/**
 * Plantilla
 */

$index = new TemplateController();
$index->index();