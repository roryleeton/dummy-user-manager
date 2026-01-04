<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Service;

use RoryLeeton\DummyUserManager\Service\APIProcessors\APIProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\CreateUserProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\GetUserProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\GetUsersProcessor;

class APIProcessorFactory
{
	public static function make(APIAction $action): APIProcessor
	{
		return match ($action) {
            APIAction::GET_USER 	=> new GetUserProcessor(),
            APIAction::GET_USERS 	=> new GetUsersProcessor(),
            APIAction::CREATE_USER	=> new CreateUserProcessor(),
		};
	}
}