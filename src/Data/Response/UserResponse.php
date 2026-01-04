<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Data\Response;

use RoryLeeton\DummyUserManager\Trait\ToArray;

/**
 * Data Transfer Object representing a user response from the API.
 *
 * This readonly class represents user data returned from API operations.
 * It implements JsonSerializable for easy conversion to JSON format.
 */
readonly final class UserResponse implements \JsonSerializable
{
	use ToArray;

	/**
	 * @param int $id The unique identifier of the user
	 * @param string $firstName The user's first name
	 * @param string $lastName The user's last name
	 * @param string $email The user's email address
	 */
	public function __construct(
		public int $id,
		public string $firstName,
		public string $lastName,
		public string $email
	) {}

	/**
	 * Creates a new UserResponse instance.
	 *
	 * @param int $id The unique identifier of the user
	 * @param string $firstName The user's first name
	 * @param string $lastName The user's last name
	 * @param string $email The user's email address
	 * @return UserResponse A new UserResponse instance
	 */
	public static function create(int $id, string $firstName, string $lastName, string $email): UserResponse 
	{
        return new self($id, $firstName, $lastName, $email);
    }

	/**
	 * Serializes the object to an array for JSON encoding.
	 *
	 * @return array<string, int|string> An associative array containing all properties
	 */
	public function jsonSerialize(): array
	{
		return $this->toArray();
	}
}