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
			firstname: 'John',
			lastname: 'Doe',
			email: 'johndoe@provider.com'
		);

		$this->assertEquals(123, $userResponse->id);
		$this->assertEquals('John', $userResponse->firstname);
		$this->assertEquals('Doe', $userResponse->lastname);
		$this->assertEquals('johndoe@provider.com', $userResponse->email);
	}

	/*
	* Confirms properties are strings
	*/
	public function testPropertiesAreStrings(): void
	{
		$userResponse = new UserResponse(
			id: 456,
			firstname: 'Jane',
			lastname: 'Smith',
			email: 'janesmith@provider.com'
		);

		// Verify properties can be read
		$this->assertIsInt($userResponse->id);
		$this->assertIsString($userResponse->firstname);
		$this->assertIsString($userResponse->lastname);
		$this->assertIsString($userResponse->email);
	}

	/*
	* Tests the toArray() method returns the expected array structure with correct values
	*/
	public function testToArrayReturnsCorrectArray(): void
	{
		$userResponse = new UserResponse(
			id: 789,
			firstname: 'Alice',
			lastname: 'Johnson',
			email: 'alicejohnson@provider.com'
		);

		$result = $userResponse->toArray();

		$this->assertIsArray($result);
		$this->assertArrayHasKey('id', $result);
		$this->assertArrayHasKey('firstname', $result);
		$this->assertArrayHasKey('lastname', $result);
		$this->assertArrayHasKey('email', $result);
		$this->assertEquals(789, $result['id']);
		$this->assertEquals('Alice', $result['firstname']);
		$this->assertEquals('Johnson', $result['lastname']);
		$this->assertEquals('alicejohnson@provider.com', $result['email']);
	}

	/*
	* Ensures toArray() includes all properties
	*/
	public function testToArrayContainsAllProperties(): void
	{
		$userResponse = new UserResponse(
			id: 101,
			firstname: 'Bob',
			lastname: 'Williams',
			email: 'bobwilliams@provider.com'
		);

		$result = $userResponse->toArray();

		$this->assertCount(4, $result);
		$this->assertEquals(['id', 'firstname', 'lastname', 'email'], array_keys($result));
	}

	/*
	* Edge case: empty string values
	*/
	public function testCanHandleEmptyStrings(): void
	{
		$userResponse = new UserResponse(
			id: 0,
			firstname: '',
			lastname: '',
			email: ''
		);

		$this->assertEquals(0, $userResponse->id);
		$this->assertEquals('', $userResponse->firstname);
		$this->assertEquals('', $userResponse->lastname);
		$this->assertEquals('', $userResponse->email);
	}

	/*
	* Edge case: long string values
	*/
	public function testCanHandleLongStrings(): void
	{
		$longUserID = 1;
		$longFirstName = str_repeat('A', 100);
		$longLastName = str_repeat('B', 100);
		$longEmail = str_repeat('C', 100);

		$userResponse = new UserResponse(
			id: $longUserID,
			firstname: $longFirstName,
			lastname: $longLastName,
			email: $longEmail
		);

		$this->assertEquals($longUserID, $userResponse->id);
		$this->assertEquals($longFirstName, $userResponse->firstname);
		$this->assertEquals($longLastName, $userResponse->lastname);
		$this->assertEquals($longEmail, $userResponse->email);
	}
}