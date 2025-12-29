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
			firstname: 'John',
			lastname: 'Doe',
			email: 'johndoe@provider.com'
		);

		$this->assertEquals('John', $createUser->firstname);
		$this->assertEquals('Doe', $createUser->lastname);
		$this->assertEquals('johndoe@provider.com', $createUser->email);
	}

	/*
	* Confirms properties are strings
	*/
	public function testPropertiesAreStringss(): void
	{
		$createUser = new CreateUser(
			firstname: 'Jane',
			lastname: 'Smith',
			email: 'janesmith@provider.com'
		);

		// Verify properties can be read
		$this->assertIsString($createUser->firstname);
		$this->assertIsString($createUser->lastname);
		$this->assertIsString($createUser->email);
	}

	/*
	* Tests the toArray() method returns the expected array structure with correct values
	*/
	public function testToArrayReturnsCorrectArray(): void
	{
		$createUser = new CreateUser(
			firstname: 'Alice',
			lastname: 'Johnson',
			email: 'alicejohnson@provider.com'
		);

		$result = $createUser->toArray();

		$this->assertIsArray($result);
		$this->assertArrayHasKey('firstname', $result);
		$this->assertArrayHasKey('lastname', $result);
		$this->assertArrayHasKey('email', $result);
		$this->assertEquals('Alice', $result['firstname']);
		$this->assertEquals('Johnson', $result['lastname']);
		$this->assertEquals('alicejohnson@provider.com', $result['email']);
	}

	/*
	* Ensures toArray() includes all properties
	*/
	public function testToArrayContainsAllProperties(): void
	{
		$createUser = new CreateUser(
			firstname: 'Bob',
			lastname: 'Williams',
			email: 'bobwilliams@provider.com'
		);

		$result = $createUser->toArray();

		$this->assertCount(3, $result);
		$this->assertEquals(['firstname', 'lastname', 'email'], array_keys($result));
	}

	/*
	* Edge case: empty string values
	*/
	public function testCanHandleEmptyStrings(): void
	{
		$createUser = new CreateUser(
			firstname: '',
			lastname: '',
			email: '',
		);

		$this->assertEquals('', $createUser->firstname);
		$this->assertEquals('', $createUser->lastname);
		$this->assertEquals('', $createUser->email);
	}

	/*
	* Edge case: long string values
	*/
	public function testCanHandleLongStrings(): void
	{
		$longFirstName = str_repeat('A', 100);
		$longLastName = str_repeat('B', 100);
		$longEmail = str_repeat('C', 100);

		$createUser = new CreateUser(
			firstname: $longFirstName,
			lastname: $longLastName,
			email: $longEmail,
		);

		$this->assertEquals($longFirstName, $createUser->firstname);
		$this->assertEquals($longLastName, $createUser->lastname);
		$this->assertEquals($longEmail, $createUser->email);
	}
}