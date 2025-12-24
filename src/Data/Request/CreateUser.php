<?php 

declare(strict_types=1);

namespace RoryLeeton\DummyUserManager\Data\Request;

use RoryLeeton\DummyUserManager\Trait\ToArray;

final class CreateUser
{
	use ToArray;

	public function __construct(
		public readonly string $firstname,
		public readonly string $lastname 
	) {}
}