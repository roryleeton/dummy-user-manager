<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Tests\Unit\Data;

use PHPUnit\Framework\TestCase;
use RoryLeeton\DummyUserManager\Data\Response\UsersResponse;

class UsersResponseTest extends TestCase
{
	/*
	* Verifies the constructor initialises property correctly
	*/
	public function testConstructorInitialisesAllProperties(): void
	{
		$usersResponse = new UsersResponse(
			users: []
		);

		$this->assertEquals([], $usersResponse->users);
	}

	/*
	* Confirms property is array
	*/
	public function testPropertyIsArray(): void
	{
		$usersResponse = new UsersResponse(
			users: []
		);

		$this->assertIsArray($usersResponse->users);
	}

	/*
	* Tests the toArray() method returns the expected array structure with correct values
	*/
	public function testToArrayReturnsCorrectArray(): void
	{
		$usersResponse = new UsersResponse(
			users: []
		);

		$result = $usersResponse->toArray();

		$this->assertIsArray($result);
		$this->assertArrayHasKey('users', $result);
		$this->assertEquals([], $result['users']);
	}

	/*
	* Tests object converts to json
	*/
	public function testJsonSerialization(): void
	{
		$usersResponse = new UsersResponse(
			users: [
				'item1',
				'item2'
			]
		);
		$this->assertIsString(json_encode($usersResponse));
		$this->assertSame(json_encode($usersResponse), '{"users":["item1","item2"]}');
	}
}