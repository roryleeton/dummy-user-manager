<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Tests\Integration;

use PHPUnit\Framework\TestCase;
use RoryLeeton\DummyUserManager\DummyUserManager as DummyUserManager;
use RoryLeeton\DummyUserManager\Data\Response\UserResponse;


class CreateUserTest extends TestCase
{
    /*
	* Tests the create user method
	*/
    public function testCreateUserResponse()
    {
		$service = new DummyUserManager('token');
		$userResponse = $service->createUser('Rory', 'Leeton', 'blarn@blarn.com');
		$this->assertInstanceOf(UserResponse::class, $userResponse);
		$this->assertIsInt($userResponse->id);
		$this->assertIsString($userResponse->firstName);
		$this->assertIsString($userResponse->lastName);
		$this->assertIsString($userResponse->email);
		$this->assertSame($userResponse->firstName, 'Rory');
		$this->assertSame($userResponse->lastName, 'Leeton');
		$this->assertSame($userResponse->email, 'blarn@blarn.com');
    }
}