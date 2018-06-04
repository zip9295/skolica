<?php
$message = '';
include('route.php');
include('functions.php');
$config = include('config/config.php');
$config = array_merge(
    $config, include('config/config-local.php')
);
$pdo = bootstrap();
include('header.phtml');

try {
    resolveRoute($config);
} catch (\Exception $e) {

}
?>
