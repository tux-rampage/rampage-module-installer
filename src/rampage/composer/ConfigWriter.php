<?php
/**
 * LICENSE: $license_text$
 *
 * @author    Axel Helmert <ah@luka.de>
 * @copyright Copyright (c) 2012 LUKA netconsult GmbH (www.luka.de)
 * @license   $license$
 * @version   $Id$
 */

namespace rampage\composer;

use RuntimeException;

/**
 * Config writer class
 */
class ConfigWriter
{
    /**
     * @var array
     */
    private $data = array();

    /**
     * @var string
     */
    private $section = '';

    /**
     * @param array $data
     * @param string $section
     */
    public function __construct(array $data, $section = null)
    {
        $this->data = $data;
        $this->section = $section;
    }

    /**
     * @param array $data
     * @return ConfigWriter
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Create flat data array
     *
     * @param array $data
     * @param string $prefix
     * @param array $result
     * @return array
     */
    private function createArrayLines(array $data, $prefix = '')
    {
        $content = '';

        foreach ($data as $key => $value) {
            $newKey = "{$prefix}[$key]";

            if (is_array($value)) {
                $content .= $this->createArrayLines($value, $newKey);
                continue;
            }

            $content .= $this->createPropertyLine($newKey, $value);
        }

        return $content;
    }

    /**
     * @param string $key
     * @param scalar $value
     * @return string
     */
    private function createPropertyLine($key, $value)
    {
        if (is_bool($value)) {
            return $key . ' = ' . ($value? 'true' : 'false') . "\n";
        }

        if (is_string($value)) {
            return $key . ' = "' . $value . "\"\n";
        }

        return $key . ' = ' . $value . "\n";
    }

    /**
     * Write config file
     *
     * @param string $file
     */
    public function write($file)
    {
        $content = '';
        if ($this->section) {
            $content .= "[{$this->section}]\n";
        }

        foreach ($this->data as $key => $value) {
            if (is_array($value)) {
                $content .= $this->createArrayLines($value, $key);
                continue;
            }

            $content .= $this->createPropertyLine($key, $value);
        }

        if (file_put_contents($file, $content) === false) {
            throw new RuntimeException('Failed to write config file: ' . $file);
        }

        return $this;
    }
}