<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Tests\Integration;

use PHPUnit\Framework\TestCase;
use RoryLeeton\DummyUserManager\DummyUserManager as DummyUserManager;

class GetUserTest extends TestCase
{
    
    public function testGetUserResponse()
    {
		$service = new DummyUserManager('token');
		$service->getUser('1');
		$this->assertInstanceOf(DummyUserManager::class, $service);
    }
}