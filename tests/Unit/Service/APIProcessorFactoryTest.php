<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use RoryLeeton\DummyUserManager\Service\APIAction;
use RoryLeeton\DummyUserManager\Service\APIProcessorFactory;
use RoryLeeton\DummyUserManager\Service\APIProcessors\APIProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\CreateUserProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\GetUserProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\GetUsersProcessor;

class APIProcessorFactoryTest extends TestCase
{
	/*
	* Verify factory returns get user processor
	*/
	public function testReturnsGetUserProcessor(): void
	{
		$action = APIAction::GET_USER;
		$processor = APIProcessorFactory::make($action);
		$this->assertInstanceOf(GetUserProcessor::class, $processor);
	}
	
	/*
	* Verify factory returns get users processor
	*/
	public function testReturnsGetUsersProcessor(): void
	{
		$action = APIAction::GET_USERS;
		$processor = APIProcessorFactory::make($action);
		$this->assertInstanceOf(GetUsersProcessor::class, $processor);
	}

	/*
	* Verify factory returns create user processor
	*/
	public function testReturnsCreateUserProcessor(): void
	{
		$action = APIAction::CREATE_USER;
		$processor = APIProcessorFactory::make($action);
		$this->assertInstanceOf(CreateUserProcessor::class, $processor);
	}

	/*
	* Verify all enum cases are handled and return valid processors
	* With enums, invalid values are impossible, so we test exhaustiveness instead
	*/
	public function testAllEnumCasesAreHandled(): void
	{
		foreach (APIAction::cases() as $action) {
			$processor = APIProcessorFactory::make($action);
			$this->assertInstanceOf(APIProcessor::class, $processor);
		}
	}
}