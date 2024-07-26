<?php
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

// Cargar el archivo .env
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();
?>