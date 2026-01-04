<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Data\Response;

use RoryLeeton\DummyUserManager\Trait\ToArray;

readonly final class UserResponse implements \JsonSerializable
{
	use ToArray;

	public function __construct(
		public int $id,
		public string $firstName,
		public string $lastName,
		public string $email
	) {}

	public static function create(int $id, string $firstName, string $lastName, string $email): UserResponse 
	{
        return new self($id, $firstName, $lastName, $email);
    }

	public function jsonSerialize(): array
	{
		return $this->toArray();
	}
}