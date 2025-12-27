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
			userID: '123'
		);

		$this->assertEquals('John', $userResponse->firstname);
		$this->assertEquals('Doe', $userResponse->lastname);
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
			userID: '456'
		);

		// Verify properties can be read
		$this->assertIsString($userResponse->firstname);
		$this->assertIsString($userResponse->lastname);
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
			userID: '789'
		);

		$result = $userResponse->toArray();

		$this->assertIsArray($result);
		$this->assertArrayHasKey('firstname', $result);
		$this->assertArrayHasKey('lastname', $result);
		$this->assertArrayHasKey('userID', $result);
		$this->assertEquals('Alice', $result['firstname']);
		$this->assertEquals('Johnson', $result['lastname']);
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
			userID: '101'
		);

		$result = $userResponse->toArray();

		$this->assertCount(3, $result);
		$this->assertEquals(['firstname', 'lastname', 'userID'], array_keys($result));
	}

	/*
	* Edge case: empty string values
	*/
	public function testCanHandleEmptyStrings(): void
	{
		$userResponse = new UserResponse(
			firstname: '',
			lastname: '',
			userID: ''
		);

		$this->assertEquals('', $userResponse->firstname);
		$this->assertEquals('', $userResponse->lastname);
		$this->assertEquals('', $userResponse->userID);
	}

	/*
	* Edge case: long string values
	*/
	public function testCanHandleLongStrings(): void
	{
		$longFirstName = str_repeat('A', 100);
		$longLastName = str_repeat('B', 100);
		$longUserID = str_repeat('1', 50);

		$userResponse = new UserResponse(
			firstname: $longFirstName,
			lastname: $longLastName,
			userID: $longUserID
		);

		$this->assertEquals($longFirstName, $userResponse->firstname);
		$this->assertEquals($longLastName, $userResponse->lastname);
		$this->assertEquals($longUserID, $userResponse->userID);
	}
}