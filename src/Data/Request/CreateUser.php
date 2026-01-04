<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Data\Request;

use RoryLeeton\DummyUserManager\Trait\ToArray;

/**
 * Data Transfer Object for creating a new user.
 *
 * This readonly class represents the data required to create a user via the API.
 * It implements JsonSerializable for easy conversion to JSON format.
 */
readonly final class CreateUser implements \JsonSerializable
{
	use ToArray;

	/**
	 * @param string $firstName The user's first name
	 * @param string $lastName The user's last name
	 * @param string $email The user's email address
	 */
	public function __construct(
		public string $firstName,
		public string $lastName,
		public string $email
	) {}

	/**
	 * Creates a new CreateUser instance.
	 *
	 * @param string $firstName The user's first name
	 * @param string $lastName The user's last name
	 * @param string $email The user's email address
	 * @return CreateUser A new CreateUser instance
	 */
	public static function create(string $firstName, string $lastName, string $email): CreateUser 
	{
        return new self($firstName, $lastName, $email);
    }

	/**
	 * Serializes the object to an array for JSON encoding.
	 *
	 * @return array<string, string> An associative array containing all properties
	 */
	public function jsonSerialize(): array
	{
		return $this->toArray();
	}
}