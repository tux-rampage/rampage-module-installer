<?php
/**
 * This is part of rampage.php
 * Copyright (c) 2012 Axel Helmert
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  library
 * @package   rampage.composer
 * @author    Axel Helmert
 * @copyright Copyright (c) 2013 Axel Helmert
 * @license   http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License
 */

namespace rampage\composer;

/**
 * Config model
 */
class Config
{
    /**
     * Data array
     *
     * @var string
     */
    private $data = array();

    /**
     * Construct
     *
     * @param array $packageExtra
     */
    public function __construct(array $packageExtra)
    {
        if (!isset($packageExtra['rampage']) || !is_array($packageExtra['rampage'])) {
            return;
        }

        $this->data = $packageExtra['rampage'];
    }

    /**
     * Check property existence
     *
     * @param string $property
     * @return bool
     */
    public function has($property)
    {
        return isset($this->data[$property]);
    }

    /**
     * Returns the property
     *
     * @param string $property
     * @return mixed
     */
    public function get($property, $default = null)
    {
        if (!$this->has($property)) {
            return $default;
        }

        return $this->data[$property];
    }
}