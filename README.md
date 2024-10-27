<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Blog Management System

## Table of Contents
- [Introduction](#introduction)
- [Installation](#installation)
- [Setup](#setup)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
- [Roles and Permissions](#roles-and-permissions)
- [Authentication](#authentication)
- [Security Considerations](#security-considerations)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

## Introduction

This Blog Management System is built on [Laravel 11](https://laravel.com/docs/11.x/) and utilizes [Laravel Sanctum](https://laravel.com/docs/11.x/sanctum#main-content) for secure authentication,as well as the [Spatie role-permission package](https://spatie.be/docs/laravel-permission/v6/introduction) to manage users, roles, and permissions efficiently. It provides a robust foundation for managing user accounts, assigning roles, and controlling access to various system features.

## Installation

To install this project, follow these steps:
1. Clone the repository:
```
git clone https://github.com/Ckabuo/blog-management-system.git
cd blog-management-system
```
2. Install dependencies:
```
composer install
```
3. Create a `.env` file, copy the `.env.example` into it, and configure your database credentials:
```
DB_CONNECTION=your_database_connection
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
4. Generate application key:
```
php artisan key:generate
```
5. Set up the database:
```
php artisan migrate
```

## Setup

Before running the application, set up the following:

1. Publish the Spatie permission configuration:
```
 composer require spatie/laravel-permission
 php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```
2. Run the seeder to create default roles and permissions:
```
php artisan db:seed
```
3. Install Laravel Sanctum:
```
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

## Usage
Run the application:
```
php artisan serve
```

## API Endpoints

### Authentication

- POST `/api/register`: Register new User.
- POST `/api/login`: Login existing User.
- POST `/api/logout`: Logout authenticated User.
- GET `/api/me`: Get Current logged-in User.

### Admin Services
- GET `/api/users`: Get all Users.
- GET `/api/users/{user}`: Get specific User's details.
- GET `/api/comments`: Get all Comments.
- GET `/api/comments/{comment}`: Get specific Comment.
- POST `/api/post`: Create New Post.
- PATCH `/api/posts/{post}`: Update a Post.
- POST `/api/posts/{post}`: Delete a Post.

### Post Services
- GET `/api/posts`: Get all Posts.
- GET `/api/posts/{post}`: Get Specific Post.
- GET `/api/posts/{post}/comments`: Get Comments belonging to a Post.
- GET `/api/posts/{post}/comments/{comment}`: Get a Comments details.
- POST `/api/posts/{post}/like`: Like a Post.

### Comment Services
- POST `/api/comment/{post}`: Create Comment for a Post.
- PATCH `/api/comments/{comment}`: Update Comment for a Post.
- DELETE `/api/comment/{comment}`: Delete Comment for a Post.

### User Services
- PUT `/api/user`: Update User Details.
- PUT `/api/change-password`: Update Password.
- DELETE `/api/users/{user}`: Delete User

## Roles and Permissions

The system has three role:
1. Super-admin: Has full access to all features/endpoints.
2. Admin: Can View User, Update User, Create Post, View Post, Update Post, Delete Post, View Comment, Create Comment, Update Comment, Delete Comment
3. User: View Comment, Create Comment, Update Comment, Delete Comment, Update User, Delete User, View Post

Permissions are automatically assigned based on the role during registration

## Authentication

Authentication is handled via Personal access tokens. When logging in, you'll receive a token that should be included in the Authorization header for subsequent requests.

Example: `Authorization: Bearer <your_token>`

## Security Considerations

1. Always validate and sanitize input data before processing.
2. Implement proper CSRF protection.
3. Use HTTPS in production environments.
4. Regularly update dependencies and Laravel core.
5. Implement proper error handling and logging.

## Troubleshooting

- Ensure all required packages are installed and up-to-date.
- Check database connections and credentials.
- Verify API routes are correctly defined in `routes/api.php`.
- Clear cache if experiencing unexpected behavior:
```
php artisan config:clear
php artisan cache: clear
php artisan route: clear
```

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request with clear explanations for any changes made.

## License

This project is licensed under the MIT License - see the [MIT license](https://opensource.org/licenses/MIT) file for details.
