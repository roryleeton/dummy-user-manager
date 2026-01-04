<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Data\Response;

use RoryLeeton\DummyUserManager\Trait\ToArray;

/**
 * Data Transfer Object representing a collection of user responses from the API.
 *
 * This readonly class represents a paginated list of users returned from API operations.
 * It implements JsonSerializable for easy conversion to JSON format.
 */
readonly final class UsersResponse implements \JsonSerializable
{
	use ToArray;

	/**
	 * @param array<int, UserResponse> $users Array of UserResponse objects
	 */
	public function __construct(
		public array $users
	) {}

	/**
	 * Creates a new UsersResponse instance.
	 *
	 * @param array<int, UserResponse> $users Array of UserResponse objects
	 * @return UsersResponse A new UsersResponse instance
	 */
	public static function create(array $users): UsersResponse 
	{
        return new self($users);
    }

	/**
	 * Serializes the object to an array for JSON encoding.
	 *
	 * @return array<string, array<int, array<string, int|string>>> An associative array containing the users property
	 */
	public function jsonSerialize(): array
	{
		return $this->toArray();
	}
}