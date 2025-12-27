<?php

namespace RoryLeeton\DummyUserManager\Service\APIProcessors;

use RoryLeeton\DummyUserManager\Data\Response\UserResponse;

class GetUsersProcessor implements APIProcessor
{
	private string $token;

	public function setAuthToken(string $token): void
	{
		$this->token = $token;
	}

	public function getAuthToken(): string
	{
		return $this->token;
	}

	public function process(): array
	{
		
	}
}