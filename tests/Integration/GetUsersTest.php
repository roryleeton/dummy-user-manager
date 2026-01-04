<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Tests\Integration;

use PHPUnit\Framework\TestCase;
use RoryLeeton\DummyUserManager\DummyUserManager as DummyUserManager;

class GetUsersTest extends TestCase
{
    
    public function testGetUsersResponse()
    {
		$service = new DummyUserManager('token');
		$service->getUsers();
		$this->assertInstanceOf(DummyUserManager::class, $service);
    }
}