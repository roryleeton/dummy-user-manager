<?php

namespace  RoryLeeton\DummyUserManager\Service\APIProcessors;

use RoryLeeton\DummyUserManager\Data\Response\UserResponse;
use RoryLeeton\DummyUserManager\Data\Response\UsersResponse;

interface APIProcessor
{
	public function process(): UserResponse|UsersResponse;
}