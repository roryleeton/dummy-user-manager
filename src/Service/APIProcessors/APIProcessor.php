<?php

namespace  RoryLeeton\DummyUserManager\Service\APIProcessors;

use RoryLeeton\DummyUserManager\Data\Response\UserResponse;

interface APIProcessor
{
	public function setAuthToken(string $token): void;
	
	public function getAuthToken(): string;

	public function process(): UserResponse|array;
}