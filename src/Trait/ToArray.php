<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Trait;

trait ToArray
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}