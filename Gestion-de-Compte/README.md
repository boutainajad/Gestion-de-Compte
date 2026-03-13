# Laravel Authentication API

## Description
This project is a RESTful API built with Laravel.  
It allows users to register, login, logout, and manage their profile using token-based authentication.

The API can be tested using Postman and does not include any frontend interface.

---

## Features

- Register a new user
- Login and receive an access token
- Logout
- View user profile
- Update profile information
- Change password
- Delete account

All profile routes are protected and require authentication.

---

## Technologies Used

- Laravel
- PHP
- MySQL
- Laravel Sanctum
- Postman

---

## Installation

### 1. Clone the repository

git clone https://github.com/your-username/laravel-auth-api.git

cd laravel-auth-api

### 2. Install dependencies

composer install

### 3. Create environment file

cp .env.example .env

### 4. Configure database

Edit the `.env` file and configure your database:

DB_DATABASE=laravel_api  
DB_USERNAME=root  
DB_PASSWORD=

### 5. Generate application key

php artisan key:generate

### 6. Run migrations

php artisan migrate

### 7. Start the server

php artisan serve

API base URL:

http://127.0.0.1:8000

---

## Authentication

After login, the API returns a token.

You must include the token in the request header for protected routes.

Example:

Authorization: Bearer YOUR_TOKEN

---

## API Routes

### Authentication

POST /api/register — Create account  
POST /api/login — Login user  
POST /api/logout — Logout user

---

### Profile (Protected Routes)

GET /api/me — Get profile  
PUT /api/me — Update profile  
PUT /api/me/password — Change password  
DELETE /api/me — Delete account

---

## Testing with Postman

1. Register a new user using `/api/register`
2. Login using `/api/login`
3. Copy the returned token
4. Add the token to request header:

Authorization: Bearer TOKEN

5. Test protected routes like `/api/me`

---

## Security

- Passwords are hashed
- Protected routes require authentication
- Users can only access their own profile
- Request validation is applied
