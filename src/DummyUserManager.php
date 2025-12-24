<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager;

use Data\Response\UserResponse;

final class DummyUserManager 
{
	private $token;

	public function __construct(string $token)
	{
		$this->token = $token;
	}

	public function getUser(string $id): UserResponse
	{

	}

	public function getUsers(): array
	{

	}

	public function createUser(string $firstname, string $lastname): UserResponse
	{

	}
}