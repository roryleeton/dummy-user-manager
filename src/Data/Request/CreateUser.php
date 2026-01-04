<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Data\Request;

use RoryLeeton\DummyUserManager\Trait\ToArray;

readonly final class CreateUser
{
	use ToArray;

	public function __construct(
		public string $firstname,
		public string $lastname,
		public string $email
	) {}

	public static function create(string $firstname, string $lastname, string $email): CreateUser 
	{
        return new self($firstname, $lastname, $email);
    }
}