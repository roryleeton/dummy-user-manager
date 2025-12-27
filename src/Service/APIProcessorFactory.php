<?php

namespace RoryLeeton\DummyUserManager\Service;

use RoryLeeton\DummyUserManager\Service\APIProcessors\APIProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\CreateUserProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\GetUserProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\GetUsersProcessor;

class APIProcessorFactory
{
	private const GET_USER 		= 'get-user';
	private const GET_USERS		= 'get-users';
	private const CREATE_USER 	= 'create-user';

	public static function make(string $action): APIProcessor
	{
		switch ($action) {
			case self::GET_USER: 	return new GetUserProcessor();
			case self::GET_USERS: 	return new GetUsersProcessor();
			case self::CREATE_USER: return new CreateUserProcessor();
			default: 				throw  new \InvalidArgumentException("Invalid API request action ({$action})");
		}
	}
}