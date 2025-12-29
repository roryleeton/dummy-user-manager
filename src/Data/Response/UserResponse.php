<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Data\Response;

use RoryLeeton\DummyUserManager\Trait\ToArray;

final class UserResponse
{
	use ToArray;

	public function __construct(
		public readonly string $firstname,
		public readonly string $lastname,
		public readonly string $email,
		public readonly string $userID
	) {}


	// Consider implementing from array method with response validation
	// public static function fromArray(array $data): self
	// {
	// 	foreach (['id', 'firstname', 'lastname', 'email'] as $key) {
	// 		if (!isset($data[$key])) {
	// 			throw new \InvalidArgumentException("Missing field: $key");
	// 		}
	// 	}

	// 	return new self(
	// 		firstname: (string) ($data['firstname'] ?? ''),
	// 		lastname: (string) ($data['lastname'] ?? ''),
	//		email: (string) ($data['email'] ?? ''),
	// 		id: (string) $data['id'],
	// 	);
	// }
}