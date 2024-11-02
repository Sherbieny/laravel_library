# Laravel Book Library Project

This is a Laravel project that includes features such as user authentication, book management, and API endpoints. The project uses Docker for containerization and includes Redis for caching.

## Prerequisites

-   Docker

## Setup Instructions

### 1. Clone the Repository

```sh
git clone `this-repository`
cd your-repository
```

### 2. Copy the Environment File

```sh
cp .env.example .env
```

### 3. Start the Docker Containers

```sh
./vendor/bin/sail up -d
```

### 4. Install Composer Dependencies

```sh
./vendor/bin/sail composer install
```

### 5. Install NPM Dependencies

```sh
./vendor/bin/sail npm install
```

### 6. Generate an App Encryption Key

```sh
./vendor/bin/sail php artisan key:generate
```

### 7. Run the Database Migrations

```sh
./vendor/bin/sail php artisan migrate
```

### 8. Seed the Database (Optional)

```sh
./vendor/bin/sail php artisan db:seed
```

### 9. Build the Frontend Assets

```sh
./vendor/bin/sail npm run dev
```

### 10. Access the Application

You can access the application at [http://localhost](http://localhost).

### 11. Run Tests

```sh
./vendor/bin/sail php artisan test
```

## API Endpoints

### Authentication

-   `POST /sanctum/token` - Get a token for the user
-   `POST /sanctum/logout` - Logout and Revoke the user's token

### Books

-   `GET /api/books` - Get all books
-   `POST /api/books` - Create a new book
-   `GET /api/books/{id}` - Get a single book
-   `PUT /api/books/{id}` - Update a book
-   `DELETE /api/books/{id}` - Delete a book

## Caching

The project uses Redis for caching.

## Security Best Practices

-   The project uses Laravel Sanctum for API authentication.
-   The project uses Laravel's validation feature to validate incoming requests.
-   The project uses Laravel's built-in query builder to protect against SQL injection attacks.
-   The project uses Laravel's built-in CSRF protection.
-   The project uses Laravel's built-in XSS protection.

## License

The Laravel Project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
