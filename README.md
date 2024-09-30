# Laravel 11 Book API

This is a simple Laravel 11 application that provides a RESTful API for managing books. The API allows you to create, retrieve, update, and delete book records.

## Installation

Follow the steps below to set up the project locally:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/thetestcoder/ajax-practice-laravel-11-api.git
   cd ajax-practice-laravel-11-api
   ```

2. **Install dependencies:**
   Make sure you have [Composer](https://getcomposer.org/) installed, then run:
   ```bash
   composer install
   ```

3. **Set up the environment:**
   Copy the `.env.example` file to `.env` and update the necessary configurations (e.g., database settings).
   ```bash
   cp .env.example .env
   ```

4. **Generate the application key:**
   ```bash
   php artisan key:generate
   ```

5. **Set up the database:**
   Make sure your database is up and running, then run the following migrations to set up the tables:
   ```bash
   php artisan migrate
   ```

6. **Run the project:**
   Start the local development server:
   ```bash
   php artisan serve
   ```

7. **Running tests:**
   To ensure everything is working correctly, you can run the included feature tests:
   ```bash
   php artisan test
   ```

## API Endpoints

Here is the list of API endpoints for managing books, along with example request/response formats.


API Endpoints
-------------

Here is the list of API endpoints for managing books and user authentication, along with example request/response formats.

### User Authentication Endpoints

#### 1\. Register a new user

-   **Endpoint:** `POST /api/register`
-   **Description:** Register a new user.
-   **Request:**
```json
{
    "name": "Test User",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```
-   **Response:**
```json
{
    "user": {
    "id": 1,
    "name": "Test User",
    "email": "test@example.com"
    },
    "token": "your-api-token"
}
```
-   **Status:** 201 Created

#### 2\. Login a user

-   **Endpoint:** `POST /api/login`
-   **Description:** Log in an existing user.
-   **Request:**
```json 
{
    "email": "test@example.com",
    "password": "password123"
}
```
-   **Response:** 
```json 
{
    "user": {
        "id": 1,
        "name": "Test User",
        "email": "test@example.com"
    },
    "token": "your-api-token"
}
```
-   **Status:** 200 OK

#### 3\. Access protected route (Authenticated)

-   **Endpoint:** `GET /api/user`
-   **Description:** Access protected route, requires authentication.
-   **Response:**
```json 
{
    "id": 1,
    "name": "Test User",
    "email": "test@example.com"
}
```
-   **Status:** 200 OK

#### 4\. Unauthorized access (Unauthenticated)

-   **Endpoint:** `GET /api/user`
-   **Description:** Attempt to access a protected route without authentication.
-   **Response:**
```json 
{
    "message": "Unauthenticated."
}
```
-   **Status:** 401 Unauthorized

## Authors API Routes

### 1. List All Authors

**Endpoint:**

```
GET /api/authors
```

**Headers:**

| Key           | Value                   |
|---------------|-------------------------|
| Authorization | Bearer {your-auth-token} |

**Response Example:**

```json
[
    {
        "id": 1,
        "name": "J.K. Rowling",
        "bio": "Author of Harry Potter",
        "created_at": "2024-09-30T12:00:00.000000Z",
        "updated_at": "2024-09-30T12:00:00.000000Z"
    },
    {
        "id": 2,
        "name": "George Orwell",
        "bio": "Author of 1984",
        "created_at": "2024-09-30T12:00:00.000000Z",
        "updated_at": "2024-09-30T12:00:00.000000Z"
    }
]
```

### 2. Create a New Author

**Endpoint:**

```
POST /api/authors
```

**Headers:**

| Key           | Value                   |
|---------------|-------------------------|
| Authorization | Bearer {your-auth-token} |

**Request Body:**

| Field | Type   | Description           |
|-------|--------|-----------------------|
| name  | string | The name of the author |
| bio   | string | The biography of the author (optional) |

**Response Example:**

```json
{
    "id": 3,
    "name": "Mark Twain",
    "bio": "Author of The Adventures of Tom Sawyer",
    "created_at": "2024-09-30T12:00:00.000000Z",
    "updated_at": "2024-09-30T12:00:00.000000Z"
}
```

### 3. Get Author by ID

**Endpoint:**

```
GET /api/authors/{id}
```

**Headers:**

| Key           | Value                   |
|---------------|-------------------------|
| Authorization | Bearer {your-auth-token} |

**Response Example:**

```json
{
    "id": 3,
    "name": "Mark Twain",
    "bio": "Author of The Adventures of Tom Sawyer",
    "created_at": "2024-09-30T12:00:00.000000Z",
    "updated_at": "2024-09-30T12:00:00.000000Z"
}
```

### 4. Update Author by ID

**Endpoint:**

```
PUT /api/authors/{id}
```

**Headers:**

| Key           | Value                   |
|---------------|-------------------------|
| Authorization | Bearer {your-auth-token} |

**Request Body:**

| Field | Type   | Description           |
|-------|--------|-----------------------|
| name  | string | The name of the author |
| bio   | string | The biography of the author (optional) |

**Response Example:**

```json
{
    "id": 3,
    "name": "Samuel Clemens",
    "bio": "Author of The Adventures of Tom Sawyer",
    "created_at": "2024-09-30T12:00:00.000000Z",
    "updated_at": "2024-09-30T12:30:00.000000Z"
}
```

### 5. Delete Author by ID

**Endpoint:**

```
DELETE /api/authors/{id}
```

**Headers:**

| Key           | Value                   |
|---------------|-------------------------|
| Authorization | Bearer {your-auth-token} |

**Response Example:**

```json
{
    "message": "Author deleted successfully"
}
```

## Error Responses

For all routes, if the provided token is invalid or missing, you will receive a `401 Unauthorized` response:

```json
{
    "message": "Unauthenticated."
}
```


### Book Management Endpoints (unprotected routes)


### 1. Get the list of books
- **Endpoint:** `GET /api/books`
- **Description:** Retrieve a list of all books.
- **Response:**
  ```json
  {
    "books": [
      {
        "id": 1,
        "title": "Book Title 1",
        "author": "Author 1"
      },
      {
        "id": 2,
        "title": "Book Title 2",
        "author": "Author 2"
      }
    ]
  }
  ```
- **Status:** 200 OK

### 2. Get a single book
- **Endpoint:** `GET /api/books/{id}`
- **Description:** Retrieve details of a single book by its ID.
- **Response:**
  ```json
  {
    "book": {
      "id": 1,
      "title": "Book Title 1",
      "author": "Author 1"
    }
  }
  ```
- **Status:** 200 OK (if found), 404 Not Found (if the book doesn't exist)

### 3. Create a new book
- **Endpoint:** `POST /api/books`
- **Description:** Create a new book.
- **Request:**
  ```json
  {
    "title": "New Book",
    "author": "New Author"
  }
  ```
- **Response:**
  ```json
  {
    "book": {
      "id": 1,
      "title": "New Book",
      "author": "New Author"
    }
  }
  ```
- **Status:** 201 Created

### 4. Update a book
- **Endpoint:** `PUT /api/books/{id}`
- **Description:** Update the details of an existing book.
- **Request:**
  ```json
  {
    "title": "Updated Book Title",
    "author": "Updated Author"
  }
  ```
- **Response:**
  ```json
  {
    "book": {
      "id": 1,
      "title": "Updated Book Title",
      "author": "Updated Author"
    }
  }
  ```
- **Status:** 200 OK

### 5. Delete a book
- **Endpoint:** `DELETE /api/books/{id}`
- **Description:** Delete a book by its ID.
- **Response:**
  ```json
  {}
  ```
- **Status:** 204 No Content

### 6. Invalid book creation request
- **Endpoint:** `POST /api/books`
- **Description:** If required fields are missing, the API will return validation errors.
- **Request:**
  ```json
  {
    "title": "",
    "author": ""
  }
  ```
- **Response:**
  ```json
  {
    "errors": {
      "title": ["The title field is required."],
      "author": ["The author field is required."]
    }
  }
  ```
- **Status:** 422 Unprocessable Entity

## Running Tests

To run the automated tests included with the project, use the following command:
```bash
php artisan test
```

The test suite covers:
- Listing books
- Retrieving a single book
- Creating a new book
- Updating a book
- Deleting a book
- Handling invalid data

## License

This project is licensed under the MIT License.
