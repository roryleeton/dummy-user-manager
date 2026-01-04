<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Data\Response;

use RoryLeeton\DummyUserManager\Trait\ToArray;

readonly final class UserResponse
{
	use ToArray;

	public function __construct(
		public int $id,
		public string $firstname,
		public string $lastname,
		public string $email
	) {}

	public static function create(int $id, string $firstname, string $lastname, string $email): UserResponse 
	{
        return new self($id, $firstname, $lastname, $email);
    }
}