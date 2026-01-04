<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Tests\Integration;

use PHPUnit\Framework\TestCase;
use RoryLeeton\DummyUserManager\DummyUserManager as DummyUserManager;

class CreateUserTest extends TestCase
{
    
    public function testCreateUserResponse()
    {
		$service = new DummyUserManager('token');
		$service->createUser('Rory', 'Leeton', 'blarn@blarn.com');
		$this->assertInstanceOf(DummyUserManager::class, $service);
    }
}