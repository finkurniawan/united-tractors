
# UNITED TRACTORS API Documentation

Welcome to the **UNITED TRACTORS** API documentation. This API allows you to manage users, product categories, and products with ease. Below you will find comprehensive details on how to interact with the API, including authentication methods, endpoints, request examples, responses, and output formats.

## Table of Contents

- [Overview](#overview)
- [Swagger](#swagger)
- [Authentication](#authentication)
- [API Endpoints](#api-endpoints)
    - [Authentication](#authentication)
    - [Category Products](#category-products)
    - [Products](#products)
- [Usage Examples](#usage-examples)
- [Contributing](#contributing)

## Overview

The API base URL is: `http://localhost:8000/api`

API Version: `1.0.0`

## Swagger File

[Swagger](docs/api/specification.yaml)

---

## API Endpoints

### Authentication

#### Register a New User

- **Endpoint:** `/register`
- **Method:** `POST`
- **Description:** Register a new user in the system.
- **Request Body:**

  ```json
  {
    "name": "John Doe",
    "email": "john.doe@example.com",
    "password": "securepassword"
  }
  ```

- **Responses:**
    - **200 OK:**

      ```json
      {
        "message": "User registered successfully."
      }
      ```

#### Login

- **Endpoint:** `/login`
- **Method:** `POST`
- **Description:** Authenticate an existing user and obtain a token.
- **Request Body:**

  ```json
  {
    "email": "john.doe@example.com",
    "password": "securepassword"
  }
  ```

- **Responses:**
    - **200 OK:**

      ```json
      {
        "token": "your_jwt_token"
      }
      ```

### Category Products

#### Create a New Category Product

- **Endpoint:** `/category-products`
- **Method:** `POST`
- **Description:** Create a new product category.
- **Request Body:**

  ```json
  {
    "name": "Electronics"
  }
  ```

- **Responses:**
    - **201 Created:**

      ```json
      {
        "id": "550e8400-e29b-41d4-a716-446655440000",
        "name": "Electronics"
      }
      ```

#### Retrieve All Categories

- **Endpoint:** `/category-products`
- **Method:** `GET`
- **Description:** Fetch a list of all product categories.
- **Responses:**
    - **200 OK:**

      ```json
      [
        {
          "id": "550e8400-e29b-41d4-a716-446655440000",
          "name": "Electronics"
        },
        {
          "id": "550e8400-e29b-41d4-a716-446655440001",
          "name": "Books"
        }
      ]
      ```

#### Retrieve a Category by ID

- **Endpoint:** `/category-products/{category_product_id}`
- **Method:** `GET`
- **Description:** Fetch a specific product category by its ID.
- **Parameters:**
    - `category_product_id` (path): The UUID of the category to retrieve.
- **Responses:**
    - **200 OK:**

      ```json
      {
        "id": "550e8400-e29b-41d4-a716-446655440000",
        "name": "Electronics"
      }
      ```

#### Update a Category Product

- **Endpoint:** `/category-products/{category_product_id}`
- **Method:** `PUT`
- **Description:** Update an existing product category.
- **Request Body:**

  ```json
  {
    "name": "Updated Electronics"
  }
  ```

- **Parameters:**
    - `category_product_id` (path): The UUID of the category to update.
- **Responses:**
    - **200 OK:**

      ```json
      {
        "id": "550e8400-e29b-41d4-a716-446655440000",
        "name": "Updated Electronics"
      }
      ```

#### Delete a Category Product

- **Endpoint:** `/category-products/{category_product_id}`
- **Method:** `DELETE`
- **Description:** Delete a specific product category.
- **Parameters:**
    - `category_product_id` (path): The UUID of the category to delete.
- **Responses:**
    - **204 No Content:** (No response body)

### Products

#### Create a New Product

- **Endpoint:** `/products`
- **Method:** `POST`
- **Description:** Add a new product to a category.
- **Request Body:** `multipart/form-data`

  ```json
  {
    "image": "imagefile",
    "category_product_id": "550e8400-e29b-41d4-a716-446655440000",
    "name": "Product Name",
    "price": "100.00"
  }
  ```

- **Responses:**
    - **201 Created:**

      ```json
      {
        "id": "550e8400-e29b-41d4-a716-446655440000",
        "category_product_id": "550e8400-e29b-41d4-a716-446655440000",
        "name": "Product Name",
        "price": "100.00",
        "image_url": "/path/to/imagefile"
      }
      ```

#### Retrieve All Products

- **Endpoint:** `/products`
- **Method:** `GET`
- **Description:** Fetch a list of all products.
- **Responses:**
    - **200 OK:**

      ```json
      [
        {
          "id": "550e8400-e29b-41d4-a716-446655440000",
          "category_product_id": "550e8400-e29b-41d4-a716-446655440000",
          "name": "Product Name",
          "price": "100.00",
          "image_url": "/path/to/imagefile"
        }
      ]
      ```

#### Retrieve a Product by ID

- **Endpoint:** `/products/{product_id}`
- **Method:** `GET`
- **Description:** Fetch details of a specific product by its ID.
- **Parameters:**
    - `product_id` (path): The UUID of the product to retrieve.
- **Responses:**
    - **200 OK:**

      ```json
      {
        "id": "550e8400-e29b-41d4-a716-446655440000",
        "category_product_id": "550e8400-e29b-41d4-a716-446655440000",
        "name": "Product Name",
        "price": "100.00",
        "image_url": "/path/to/imagefile"
      }
      ```

#### Update a Product

- **Endpoint:** `/products/{product_id}`
- **Method:** `POST`
- **Description:** Update details of an existing product.
- **Request Body:** `multipart/form-data`

  ```json
  {
    "image": "updatedimagefile",
    "category_product_id": "550e8400-e29b-41d4-a716-446655440000",
    "name": "Updated Product Name",
    "price": "150.00"
  }
  ```

- **Parameters:**
    - `_method` (query): Use `PUT` to perform an update.
    - `product_id` (path): The UUID of the product to update.
- **Responses:**
    - **200 OK:**

      ```json
      {
        "id": "550e8400-e29b-41d4-a716-446655440000",
        "category_product_id": "550e8400-e29b-41d4-a716-446655440000",
        "name": "Updated Product Name",
        "price": "150.00",
        "image_url": "/path/to/updatedimagefile"
      }
      ```

#### Delete a Product

- **Endpoint:** `/products/{product_id}`
- **Method:** `DELETE`
- **Description:** Delete a specific product.
- **Parameters:**
    - `product_id` (path): The UUID of the product to delete.
- **Responses:**
    - **204 No Content:** (No response body)

## Usage Examples

### Example: Register a New User

```bash
curl -X POST "http://localhost:8000/api/register" \
-H "Content-Type: application/json" \
-d '{
  "name": "Jane Doe",
  "email": "jane.doe@example.com",
  "password": "mypassword123"
}'
```

### Example: Log In

```bash
curl -X POST "http://localhost:8000/api/login" \
-H "Content-Type: application/json" \
-d '{
  "email": "jane.doe@example.com",
  "password": "mypassword123"
}'
```

### Example: Create a New Product Category

```bash
curl -X POST "http://localhost:8000/api/category-products" \
-H "Content-Type: application/json" \
-H "Authorization: Bearer your_jwt_token" \
-d '{
  "name": "Books"
}'
```

### Example: Retrieve All Product Categories

```bash
curl -X GET "http://localhost:8000/api/category-products" \
-H "Authorization: Bearer your_jwt_token"
```

### Example: Retrieve a Category by ID

```bash
curl -X GET "http://localhost:8000/api/category-products/550e8400-e29b-41d4-a716-446655440000" \
-H "Authorization: Bearer your_jwt_token"
```

### Example: Update a Product Category

```bash
curl -X PUT "http://localhost:8000/api/category-products/550e8400-e29b-41d4-a716-446655440000" \
-H "Content-Type: application/json" \
-H "Authorization: Bearer your_jwt_token" \
-d '{
  "name": "Updated Books"
}'
```

### Example: Delete a Product Category

```bash
curl -X DELETE "http://localhost:8000/api/category-products/550e8400-e29b-41d4-a716-446655440000" \
-H "Authorization: Bearer your_jwt_token"
```

### Example: Create a New Product

```bash
curl -X POST "http://localhost:8000/api/products" \
-H "Content-Type: multipart/form-data" \
-H "Authorization: Bearer your_jwt_token" \
-F "image=@/path/to/image.jpg" \
-F "category_product_id=550e8400-e29b-41d4-a716-446655440000" \
-F "name=The Great Gatsby" \
-F "price=15.99"
```

### Example: Retrieve All Products

```bash
curl -X GET "http://localhost:8000/api/products" \
-H "Authorization: Bearer your_jwt_token"
```

### Example: Retrieve a Product by ID

```bash
curl -X GET "http://localhost:8000/api/products/550e8400-e29b-41d4-a716-446655440000" \
-H "Authorization: Bearer your_jwt_token"
```

### Example: Update a Product

```bash
curl -X POST "http://localhost:8000/api/products/550e8400-e29b-41d4-a716-446655440000?_method=PUT" \
-H "Content-Type: multipart/form-data" \
-H "Authorization: Bearer your_jwt_token" \
-F "image=@/path/to/updated_image.jpg" \
-F "category_product_id=550e8400-e29b-41d4-a716-446655440000" \
-F "name=Updated Product Name" \
-F "price=19.99"
```

### Example: Delete a Product

```bash
curl -X DELETE "http://localhost:8000/api/products/550e8400-e29b-41d4-a716-446655440000" \
-H "Authorization: Bearer your_jwt_token"
```

## Contributing

We welcome contributions to improve the API. To contribute:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes and commit them (`git commit -am 'Add new feature'`).
4. Push your branch to the forked repository (`git push origin feature-branch`).
5. Open a pull request to the main repository.

---
