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
			firstname: 'John',
			lastname: 'Doe',
			email: 'johndoe@provider.com',
			userID: '123'
		);

		$this->assertEquals('John', $userResponse->firstname);
		$this->assertEquals('Doe', $userResponse->lastname);
		$this->assertEquals('johndoe@provider.com', $userResponse->email);
		$this->assertEquals('123', $userResponse->userID);
	}

	/*
	* Confirms properties are strings
	*/
	public function testPropertiesAreStrings(): void
	{
		$userResponse = new UserResponse(
			firstname: 'Jane',
			lastname: 'Smith',
			email: 'janesmith@provider.com',
			userID: '456'
		);

		// Verify properties can be read
		$this->assertIsString($userResponse->firstname);
		$this->assertIsString($userResponse->lastname);
		$this->assertIsString($userResponse->email);
		$this->assertIsString($userResponse->userID);
	}

	/*
	* Tests the toArray() method returns the expected array structure with correct values
	*/
	public function testToArrayReturnsCorrectArray(): void
	{
		$userResponse = new UserResponse(
			firstname: 'Alice',
			lastname: 'Johnson',
			email: 'alicejohnson@provider.com',
			userID: '789'
		);

		$result = $userResponse->toArray();

		$this->assertIsArray($result);
		$this->assertArrayHasKey('firstname', $result);
		$this->assertArrayHasKey('lastname', $result);
		$this->assertArrayHasKey('email', $result);
		$this->assertArrayHasKey('userID', $result);
		$this->assertEquals('Alice', $result['firstname']);
		$this->assertEquals('Johnson', $result['lastname']);
		$this->assertEquals('alicejohnson@provider.com', $result['email']);
		$this->assertEquals('789', $result['userID']);
	}

	/*
	* Ensures toArray() includes all properties
	*/
	public function testToArrayContainsAllProperties(): void
	{
		$userResponse = new UserResponse(
			firstname: 'Bob',
			lastname: 'Williams',
			email: 'bobwilliams@provider.com',
			userID: '101'
		);

		$result = $userResponse->toArray();

		$this->assertCount(4, $result);
		$this->assertEquals(['firstname', 'lastname', 'email', 'userID'], array_keys($result));
	}

	/*
	* Edge case: empty string values
	*/
	public function testCanHandleEmptyStrings(): void
	{
		$userResponse = new UserResponse(
			firstname: '',
			lastname: '',
			email: '',
			userID: ''
		);

		$this->assertEquals('', $userResponse->firstname);
		$this->assertEquals('', $userResponse->lastname);
		$this->assertEquals('', $userResponse->email);
		$this->assertEquals('', $userResponse->userID);
	}

	/*
	* Edge case: long string values
	*/
	public function testCanHandleLongStrings(): void
	{
		$longFirstName = str_repeat('A', 100);
		$longLastName = str_repeat('B', 100);
		$longEmail = str_repeat('C', 100);
		$longUserID = str_repeat('1', 50);

		$userResponse = new UserResponse(
			firstname: $longFirstName,
			lastname: $longLastName,
			email: $longEmail,
			userID: $longUserID
		);

		$this->assertEquals($longFirstName, $userResponse->firstname);
		$this->assertEquals($longLastName, $userResponse->lastname);
		$this->assertEquals($longEmail, $userResponse->email);
		$this->assertEquals($longUserID, $userResponse->userID);
	}
}