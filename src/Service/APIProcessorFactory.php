<?php

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Service;

use RoryLeeton\DummyUserManager\Service\APIProcessors\APIProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\CreateUserProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\GetUserProcessor;
use RoryLeeton\DummyUserManager\Service\APIProcessors\GetUsersProcessor;

/**
 * Factory for creating API processor instances based on action type.
 *
 * This factory creates the appropriate processor implementation for a given
 * API action, allowing for a clean separation between action types and their
 * corresponding processors.
 */
class APIProcessorFactory
{
	/**
	 * Creates an API processor instance for the given action.
	 *
	 * @param APIAction $action The API action to create a processor for
	 * @return APIProcessor The appropriate processor instance for the action
	 */
	public static function make(APIAction $action): APIProcessor
	{
		return match ($action) {
            APIAction::GET_USER 	=> new GetUserProcessor(),
            APIAction::GET_USERS 	=> new GetUsersProcessor(),
            APIAction::CREATE_USER	=> new CreateUserProcessor(),
		};
	}
}