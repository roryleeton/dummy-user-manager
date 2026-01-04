<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Tests\Unit\Data;

use PHPUnit\Framework\TestCase;
use RoryLeeton\DummyUserManager\Data\Response\UserResponse;

class UserResponseTest extends TestCase
{
	/*
	* Verifies the constructor initialises all three properties correctly
	*/
	public function testConstructorInitialisesAllProperties(): void
	{
		$userResponse = new UserResponse(
			id: 123,
			firstName: 'John',
			lastName: 'Doe',
			email: 'johndoe@provider.com'
		);

		$this->assertEquals(123, $userResponse->id);
		$this->assertEquals('John', $userResponse->firstName);
		$this->assertEquals('Doe', $userResponse->lastName);
		$this->assertEquals('johndoe@provider.com', $userResponse->email);
	}

	/*
	* Confirms properties are strings
	*/
	public function testPropertiesAreStrings(): void
	{
		$userResponse = new UserResponse(
			id: 456,
			firstName: 'Jane',
			lastName: 'Smith',
			email: 'janesmith@provider.com'
		);

		// Verify properties can be read
		$this->assertIsInt($userResponse->id);
		$this->assertIsString($userResponse->firstName);
		$this->assertIsString($userResponse->lastName);
		$this->assertIsString($userResponse->email);
	}

	/*
	* Tests the toArray() method returns the expected array structure with correct values
	*/
	public function testToArrayReturnsCorrectArray(): void
	{
		$userResponse = new UserResponse(
			id: 789,
			firstName: 'Alice',
			lastName: 'Johnson',
			email: 'alicejohnson@provider.com'
		);

		$result = $userResponse->toArray();

		$this->assertIsArray($result);
		$this->assertArrayHasKey('id', $result);
		$this->assertArrayHasKey('firstName', $result);
		$this->assertArrayHasKey('lastName', $result);
		$this->assertArrayHasKey('email', $result);
		$this->assertEquals(789, $result['id']);
		$this->assertEquals('Alice', $result['firstName']);
		$this->assertEquals('Johnson', $result['lastName']);
		$this->assertEquals('alicejohnson@provider.com', $result['email']);
	}

	/*
	* Ensures toArray() includes all properties
	*/
	public function testToArrayContainsAllProperties(): void
	{
		$userResponse = new UserResponse(
			id: 101,
			firstName: 'Bob',
			lastName: 'Williams',
			email: 'bobwilliams@provider.com'
		);

		$result = $userResponse->toArray();

		$this->assertCount(4, $result);
		$this->assertEquals(['id', 'firstName', 'lastName', 'email'], array_keys($result));
	}

	/*
	* Tests object converts to json
	*/
	public function testJsonSerialization(): void
	{
		$userResponse = new UserResponse(
			id: 101,
			firstName: 'Bob',
			lastName: 'Williams',
			email: 'bobwilliams@provider.com'
		);

		$this->assertIsString(json_encode($userResponse));
		$this->assertSame(json_encode($userResponse), '{"id":101,"firstName":"Bob","lastName":"Williams","email":"bobwilliams@provider.com"}')
;	}

	/*
	* Edge case: empty string values
	*/
	public function testCanHandleEmptyStrings(): void
	{
		$userResponse = new UserResponse(
			id: 0,
			firstName: '',
			lastName: '',
			email: ''
		);

		$this->assertEquals(0, $userResponse->id);
		$this->assertEquals('', $userResponse->firstName);
		$this->assertEquals('', $userResponse->lastName);
		$this->assertEquals('', $userResponse->email);
	}

	/*
	* Edge case: long string values
	*/
	public function testCanHandleLongStrings(): void
	{
		$longUserID = 1;
		$longfirstName = str_repeat('A', 100);
		$longlastName = str_repeat('B', 100);
		$longEmail = str_repeat('C', 100);

		$userResponse = new UserResponse(
			id: $longUserID,
			firstName: $longfirstName,
			lastName: $longlastName,
			email: $longEmail
		);

		$this->assertEquals($longUserID, $userResponse->id);
		$this->assertEquals($longfirstName, $userResponse->firstName);
		$this->assertEquals($longlastName, $userResponse->lastName);
		$this->assertEquals($longEmail, $userResponse->email);
	}
}