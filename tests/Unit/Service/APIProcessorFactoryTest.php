<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use RoryLeeton\DummyUserManager\Service\APIProcessorFactory;
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
		$action = 'get-user';
		$processor = APIProcessorFactory::make($action);
		$this->assertInstanceOf(GetUserProcessor::class, $processor);
	}
	
	/*
	* Verify factory returns get users processor
	*/
	public function testReturnsGetUsersProcessor(): void
	{
		$action = 'get-users';
		$processor = APIProcessorFactory::make($action);
		$this->assertInstanceOf(GetUsersProcessor::class, $processor);
	}

	/*
	* Verify factory returns create user processor
	*/
	public function testReturnsCreateUserProcessor(): void
	{
		$action = 'create-user';
		$processor = APIProcessorFactory::make($action);
		$this->assertInstanceOf(CreateUserProcessor::class, $processor);
	}

	/*
	* Verify factory returns NULL on invalid action
	*/
	public function testInvalidAction(): void
	{
		$action = 'invalid-action';
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage("Invalid API request action ({$action})");
		$processor = APIProcessorFactory::make($action);
	}
}