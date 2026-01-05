<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Tests\Integration;

use PHPUnit\Framework\TestCase;
use RoryLeeton\DummyUserManager\DummyUserManager as DummyUserManager;
use RoryLeeton\DummyUserManager\Data\Response\UserResponse;

class GetUserTest extends TestCase
{
    /*
	* Tests the get user method
	*/
    public function testGetUserResponse()
    {
		$service = new DummyUserManager();
		$userResponse = $service->getUser(1);

		$this->assertInstanceOf(UserResponse::class, $userResponse);
		$this->assertIsInt($userResponse->id);
		$this->assertIsString($userResponse->firstName);
		$this->assertIsString($userResponse->lastName);
		$this->assertIsString($userResponse->email);

    }
}