<?php
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

// Cargar el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
?>