# Dummy User Manager

A simple, framework-agnostic PHP package that provides a service for retrieving and creating users via the [DummyJSON API](https://dummyjson.com/).

## Features

- ✅ Create new users
- ✅ Retrieve a single user by ID
- ✅ Retrieve a paginated list of users
- ✅ Comprehensive exception handling for API errors
- ✅ Framework-agnostic design
- ✅ PSR-18 HTTP client compatible
- ✅ Fully typed with PHPStan support

## Requirements

- PHP 8.2 or higher
- Composer

## Installation

Since this package is not available on Packagist, you must install it manually via Git.

### Step 1: Add the repository to your `composer.json`

Add the following repository configuration to your `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/roryleeton/dummy-user-manager.git"
        }
    ],
    "require": {
        "roryleeton/dummy-user-manager": "dev-main"
    }
}
```

### Step 2: Install via Composer

```bash
git clone https://github.com/roryleeton/dummy-user-manager.git
cd dummy-user-manager
composer install
```

## Usage

### Basic Example

```php
<?php

use RoryLeeton\DummyUserManager\DummyUserManager;

// Initialise the service
$userManager = new DummyUserManager();

// Create a new user
$user = $userManager->createUser('John', 'Doe', 'john.doe@example.com');
echo "Created user: {$user->firstName} {$user->lastName} (ID: {$user->id})\n";

// Retrieve a user by ID
$user = $userManager->getUser(1);
echo "User: {$user->firstName} {$user->lastName} ({$user->email})\n";

// Retrieve all users
$users = $userManager->getUsers();
foreach ($users->users as $user) {
    echo "User: {$user->firstName} {$user->lastName}\n";
}
```

### Response Objects

#### UserResponse

The `createUser()` and `getUser()` methods return a `UserResponse` object:

```php
$user = $userManager->getUser(1);

// Access properties
$user->id;        // int
$user->firstName; // string
$user->lastName;  // string
$user->email;     // string

// Convert to array
$array = $user->toArray();

// JSON serialization
$json = json_encode($user);
```

#### UsersResponse

The `getUsers()` method returns a `UsersResponse` object:

```php
$usersResponse = $userManager->getUsers();

// Access the users array
foreach ($usersResponse->users as $user) {
    // Each $user is a UserResponse object
    echo $user->firstName;
}

// Convert to array
$array = $usersResponse->toArray();

// JSON serialization
$json = json_encode($usersResponse);
```

## Exception Handling

All methods may throw exceptions. It's recommended to handle them appropriately:

### API Exceptions

The following exceptions extend `APIException` and are thrown based on HTTP status codes:

- `BadRequestException` (400) - Invalid request syntax or malformed data
- `UnauthorizedException` (401) - Missing or invalid authentication
- `ForbiddenException` (403) - Insufficient permissions
- `NotFoundException` (404) - Resource not found
- `ValidationException` (422) - Validation errors
- `ServerErrorException` (500+) - Server-side errors
- `APIException` - Generic API error for other status codes

### Network Exception

- `NetworkException` - Thrown when a network-level error occurs (connection timeout, DNS failure, etc.)

### Example Error Handling

```php
<?php

use RoryLeeton\DummyUserManager\DummyUserManager;
use RoryLeeton\DummyUserManager\Exception\APIException;
use RoryLeeton\DummyUserManager\Exception\NetworkException;
use RoryLeeton\DummyUserManager\Exception\NotFoundException;
use RoryLeeton\DummyUserManager\Exception\ValidationException;

$userManager = new DummyUserManager();

try {
    $user = $userManager->getUser(999);
} catch (NotFoundException $e) {
    echo "User not found: " . $e->getMessage() . "\n";
    echo "Status code: " . $e->getStatusCode() . "\n";
} catch (ValidationException $e) {
    echo "Validation error: " . $e->getMessage() . "\n";
} catch (APIException $e) {
    echo "API error: " . $e->getMessage() . "\n";
    echo "Status code: " . $e->getStatusCode() . "\n";
} catch (NetworkException $e) {
    echo "Network error: " . $e->getMessage() . "\n";
}
```

## API Reference

### DummyUserManager

#### `__construct(string $token)`

Initialises the DummyUserManager service.

**Parameters:**
- `$token` (string) - API token for authentication (currently not used by DummyJSON API, but reserved for future use)

#### `createUser(string $firstName, string $lastName, string $email): UserResponse`

Creates a new user with the provided details.

**Parameters:**
- `$firstName` (string) - The user's first name
- `$lastName` (string) - The user's last name
- `$email` (string) - The user's email address

**Returns:** `UserResponse` - The created user response

**Throws:**
- `APIException` - When the API returns an error status code
- `NetworkException` - When a network error occurs during the request

#### `getUser(int $id): UserResponse`

Retrieves a user by their ID.

**Parameters:**
- `$id` (int) - The unique identifier of the user

**Returns:** `UserResponse` - The user response data

**Throws:**
- `APIException` - When the API returns an error status code
- `NetworkException` - When a network error occurs during the request

#### `getUsers(): UsersResponse`

Retrieves a paginated list of users.

**Returns:** `UsersResponse` - The collection of users

**Throws:**
- `APIException` - When the API returns an error status code
- `NetworkException` - When a network error occurs during the request

## Architecture

The package follows a clean architecture pattern:

- **Service Layer**: `DummyUserManager` provides the main API
- **Processor Layer**: Handles specific API operations (`CreateUserProcessor`, `GetUserProcessor`, `GetUsersProcessor`)
- **Data Transfer Objects**: `UserResponse`, `UsersResponse`, `CreateUser` for type-safe data handling
- **Exception Handling**: Comprehensive exception hierarchy for different error scenarios
- **HTTP Client**: Uses PSR-18 compatible HTTP client (Symfony HTTP Client by default)


## Dependencies

### Required

- `php`: ^8.2
- `psr/http-message`: ^2.0
- `psr/http-client`: ^1.0
- `psr/http-factory`: ^1.1
- `nyholm/psr7`: ^1.8
- `symfony/http-client`: ^8.0

### Development

- `phpunit/phpunit`: 12.5.4
- `phpstan/phpstan`: ^2.1

