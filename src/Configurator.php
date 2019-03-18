<?php

namespace DockerManager;

use Symfony\Component\Yaml\Yaml;
use DockerManager\Exceptions\ConfigurationFileNotFound;

class Configurator
{
    /**
     * @var string
     */
    private static $path = __DIR__ . '/../config.yaml';

    /**
     * @var array
     */
    private static $configurations = [];

    /**
     * @return string
     */
    public static function getConfigPath()
    {
        return self::$path;
    }

    /**
     * @param string $path
     */
    public static function setConfigPath(string $path)
    {
        self::$path = $path;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function get($key, $default = null)
    {
        if (empty(self::$configurations)) {
            try {
                self::load();
            } catch (ConfigurationFileNotFound $error) {
                exit($error->getMessage());
            }
        }

        return key_exists($key, self::$configurations) ? self::$configurations[$key] : $default;
    }

    /**
     * @throws ConfigurationFileNotFound
     */
    public static function load()
    {
        if (!file_exists(self::$path)) {
            throw new ConfigurationFileNotFound('Configuration file ' . self::$path
              . " is require. Please create config.yaml, use config.example.yaml as example.");
        }

        self::$configurations = Yaml::parseFile(self::$path);
    }

    /**
     * @throws ConfigurationFileNotFound
     * @return array
     */
    public static function all()
    {
        if (empty(self::$configurations)) {
            self::load();
        }

        return self::$configurations;
    }
}
