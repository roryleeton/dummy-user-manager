<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Trait;

/**
 * Trait that provides array conversion functionality for objects.
 *
 * This trait adds a method to convert an object's public properties
 * into an associative array, commonly used for JSON serialization.
 */
trait ToArray
{
    /**
     * Converts the object's public properties to an associative array.
     *
     * @return array<string, mixed> An associative array containing all public properties of the object
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}