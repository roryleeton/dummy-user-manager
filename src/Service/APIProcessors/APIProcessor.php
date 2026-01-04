<?php

namespace  RoryLeeton\DummyUserManager\Service\APIProcessors;

use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use RoryLeeton\DummyUserManager\Data\Response\UsersResponse;

/**
 * Interface for API processors that handle specific API operations.
 *
 * Processors implementing this interface are responsible for executing
 * API requests and transforming the responses into appropriate response
 * objects. Each processor handles a specific API action type.
 */
interface APIProcessor
{
	/**
	 * Processes the API request and returns the appropriate response.
	 *
	 * @return UserResponse|UsersResponse The processed API response, either a single user or a collection of users
	 */
	public function process(): UserResponse|UsersResponse;
}