<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Data\Request;

use RoryLeeton\DummyUserManager\Trait\ToArray;

readonly final class CreateUser implements \JsonSerializable
{
	use ToArray;

	public function __construct(
		public string $firstName,
		public string $lastName,
		public string $email
	) {}

	public static function create(string $firstName, string $lastName, string $email): CreateUser 
	{
        return new self($firstName, $lastName, $email);
    }

	public function jsonSerialize(): array
	{
		return $this->toArray();
	}
}