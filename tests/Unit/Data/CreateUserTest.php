<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Tests\Unit\Data;

use PHPUnit\Framework\TestCase;
use RoryLeeton\DummyUserManager\Data\Request\CreateUser;

class CreateUserTest extends TestCase
{
	/*
	* Verifies the constructor initialises all three properties correctly
	*/
	public function testConstructorInitialisesAllProperties(): void
	{
		$createUser = new CreateUser(
			firstName: 'John',
			lastName: 'Doe',
			email: 'johndoe@provider.com'
		);

		$this->assertEquals('John', $createUser->firstName);
		$this->assertEquals('Doe', $createUser->lastName);
		$this->assertEquals('johndoe@provider.com', $createUser->email);
	}

	/*
	* Confirms properties are strings
	*/
	public function testPropertiesAreStringss(): void
	{
		$createUser = new CreateUser(
			firstName: 'Jane',
			lastName: 'Smith',
			email: 'janesmith@provider.com'
		);

		// Verify properties can be read
		$this->assertIsString($createUser->firstName);
		$this->assertIsString($createUser->lastName);
		$this->assertIsString($createUser->email);
	}

	/*
	* Tests the toArray() method returns the expected array structure with correct values
	*/
	public function testToArrayReturnsCorrectArray(): void
	{
		$createUser = new CreateUser(
			firstName: 'Alice',
			lastName: 'Johnson',
			email: 'alicejohnson@provider.com'
		);

		$result = $createUser->toArray();

		$this->assertIsArray($result);
		$this->assertArrayHasKey('firstName', $result);
		$this->assertArrayHasKey('lastName', $result);
		$this->assertArrayHasKey('email', $result);
		$this->assertEquals('Alice', $result['firstName']);
		$this->assertEquals('Johnson', $result['lastName']);
		$this->assertEquals('alicejohnson@provider.com', $result['email']);
	}

	/*
	* Ensures toArray() includes all properties
	*/
	public function testToArrayContainsAllProperties(): void
	{
		$createUser = new CreateUser(
			firstName: 'Bob',
			lastName: 'Williams',
			email: 'bobwilliams@provider.com'
		);

		$result = $createUser->toArray();

		$this->assertCount(3, $result);
		$this->assertEquals(['firstName', 'lastName', 'email'], array_keys($result));
	}

	/*
	* Edge case: empty string values
	*/
	public function testCanHandleEmptyStrings(): void
	{
		$createUser = new CreateUser(
			firstName: '',
			lastName: '',
			email: '',
		);

		$this->assertEquals('', $createUser->firstName);
		$this->assertEquals('', $createUser->lastName);
		$this->assertEquals('', $createUser->email);
	}

	/*
	* Edge case: long string values
	*/
	public function testCanHandleLongStrings(): void
	{
		$longfirstName = str_repeat('A', 100);
		$longlastName = str_repeat('B', 100);
		$longEmail = str_repeat('C', 100);

		$createUser = new CreateUser(
			firstName: $longfirstName,
			lastName: $longlastName,
			email: $longEmail,
		);

		$this->assertEquals($longfirstName, $createUser->firstName);
		$this->assertEquals($longlastName, $createUser->lastName);
		$this->assertEquals($longEmail, $createUser->email);
	}
}