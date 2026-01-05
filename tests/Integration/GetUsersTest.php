<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Tests\Integration;

use PHPUnit\Framework\TestCase;
use RoryLeeton\DummyUserManager\DummyUserManager as DummyUserManager;
use RoryLeeton\DummyUserManager\Data\Response\UsersResponse;

class GetUsersTest extends TestCase
{
    /*
	* Tests the get users method
	*/
    public function testGetUsersResponse()
    {
		$service = new DummyUserManager('token');
		$usersResponse = $service->getUsers();
		$this->assertInstanceOf(UsersResponse::class, $usersResponse);
		$this->assertIsArray($usersResponse->users);
		$this->assertIsInt($usersResponse->users[0]->id);
		$this->assertIsString($usersResponse->users[0]->firstName);
		$this->assertIsString($usersResponse->users[0]->lastName);
		$this->assertIsString($usersResponse->users[0]->email);
    }
}