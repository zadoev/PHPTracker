<?php

namespace PHPTracker\Bencode\Value;

/**
 * One piece of a decoded bencode value. Could be integer, string, dictionary or list.
 *
 * @package PHPTracker
 * @subpackage Bencode
 */
abstract class AbstractValue
{
    /**
     * PHP representation of the value that this object holds.
     *
     * @var mixed
     */
    private $value;

    /**
     * Convert the object back to a bencoded string when used as string.
     */
    abstract public function __toString();

    /**
     * Represent the value of the object as PHP arrays and scalars.
     */
    abstract public function represent();
}
