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
		);

		$this->assertEquals('John', $createUser->firstname);
		$this->assertEquals('Doe', $createUser->lastname);
	}

	/*
	* Confirms properties are readable and are strings
	*/
	public function testPropertiesAreReadonly(): void
	{
		$createUser = new CreateUser(
			firstname: 'Jane',
			lastname: 'Smith',
		);

		// Verify properties can be read
		$this->assertIsString($createUser->firstname);
		$this->assertIsString($createUser->lastname);
	}

	/*
	* Tests the toArray() method returns the expected array structure with correct values
	*/
	public function testToArrayReturnsCorrectArray(): void
	{
		$createUser = new CreateUser(
			firstname: 'Alice',
			lastname: 'Johnson',
		);

		$result = $createUser->toArray();

		$this->assertIsArray($result);
		$this->assertArrayHasKey('firstname', $result);
		$this->assertArrayHasKey('lastname', $result);
		$this->assertEquals('Alice', $result['firstname']);
		$this->assertEquals('Johnson', $result['lastname']);
	}

	/*
	* Ensures toArray() includes all three properties
	*/
	public function testToArrayContainsAllProperties(): void
	{
		$createUser = new CreateUser(
			firstname: 'Bob',
			lastname: 'Williams',
		);

		$result = $createUser->toArray();

		$this->assertCount(2, $result);
		$this->assertEquals(['firstname', 'lastname'], array_keys($result));
	}

	/*
	* Edge case: empty string values
	*/
	public function testCanHandleEmptyStrings(): void
	{
		$createUser = new CreateUser(
			firstname: '',
			lastname: '',
		);

		$this->assertEquals('', $createUser->firstname);
		$this->assertEquals('', $createUser->lastname);
	}

	/*
	* Edge case: long string values
	*/
	public function testCanHandleLongStrings(): void
	{
		$longFirstName = str_repeat('A', 100);
		$longLastName = str_repeat('B', 100);

		$createUser = new CreateUser(
			firstname: $longFirstName,
			lastname: $longLastName,
		);

		$this->assertEquals($longFirstName, $createUser->firstname);
		$this->assertEquals($longLastName, $createUser->lastname);
	}
}