<?php

namespace DockerManager;

class FilesystemUtils
{
    public static function recursiveFileSearch($path, $searchmask = '*')
    {
        $path = rtrim($path, '/');

        $files = [];
        if (is_array($searchmask)) {
            $csearchmask = count($searchmask);

            for ($i = 0; $i < $csearchmask; $i++) {
                $files = array_merge($files, glob($path . '/' . $searchmask[$i]));
            }

            sort($files);
        } else {
            $files = glob($path . '/' . $searchmask);
        }

        $dirs = glob($path . '/*', GLOB_ONLYDIR);
        foreach ($dirs as $dir) {
            if (is_dir($dir)) {
                $files = array_merge($files, self::recursiveFileSearch($dir, $searchmask));
            }
        }

        sort($files);
        return $files;
    }

    public static function copyFiles($from, $to)
    {
        self::xcopy($from, $to);
    }


    /**
     * Copy a file, or recursively copy a folder and its contents
     * @author      Aidan Lister <aidan@php.net>
     * @version     1.0.1
     * @link        http://aidanlister.com/2004/04/recursively-copying-directories-in-php/
     * @param       string $source Source path
     * @param       string $dest Destination path
     * @param       int $permissions New folder creation permissions
     * @return      bool     Returns true on success, false on failure
     */
    protected static function xcopy($source, $dest, $permissions = 0755)
    {
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }

        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }

        // Make destination directory
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }

        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            // Deep copy directories
            self::xcopy("$source/$entry", "$dest/$entry", $permissions);
        }

        // Clean up
        $dir->close();
        return true;
    }
}