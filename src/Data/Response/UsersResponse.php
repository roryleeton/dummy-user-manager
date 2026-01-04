<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Data\Response;

use RoryLeeton\DummyUserManager\Trait\ToArray;

readonly final class UsersResponse implements \JsonSerializable
{
	use ToArray;

	public function __construct(
		public array $users
	) {}

	public static function create(array $users): UsersResponse 
	{
        return new self($users);
    }

	public function jsonSerialize(): array
	{
		return $this->toArray();
	}
}