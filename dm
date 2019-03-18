#!/usr/bin/env php
<?php
foreach ([
           __DIR__ . '/../../autoload.php',
           __DIR__ . '/../vendor/autoload.php',
           __DIR__ . '/vendor/autoload.php'
         ] as $file) {
    if (file_exists($file)) {
        define('DOCKERMANAGER_COMPOSER_INSTALL', $file);

        break;
    }
}

require DOCKERMANAGER_COMPOSER_INSTALL;


(new \DockerManager\Runner())->execute();