# Laravel 12 Assessment

This project is a small API built with Laravel 12.

REST API endpoint that given a list of products, applies some discounts to them and can be filtered by category and price. It implements the following rules to apply the discounts:

1. [x] Products in the "insurance" category have a 30% discount.
2. [x] The product with sku = 000003 has a 15% discount.

Important: The prices are integers for example, 100.00€ would be 10000.

## Requirements

- PHP 8.2 or higher
- Composer

## Installation

1. Clone this repository:

    ```bash
    git clone git@github.com:stevensgsp/hq-rental-assessment.git
    cd hq-rental-assessment
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Copy the .env.example file and rename it to .env:

    ```bash
    cp .env.example .env
    ```

4. Generate the application key:

    ```bash
    php artisan key:generate
    ```

5. Run migrations and seed the database:

    ```bash
    php artisan migrate --seed
    ```

7. Start the development server:

    ```bash
    php artisan serve
    ```

The API will be available at http://localhost:8000.

## Available Endpoint

`GET /api/products`

Returns a list of products. You can filter the results by:

### Category:

- By Category ID:

    ```http
    GET /api/products?filter[category_id]=2
    ```

- By Category Name:

    ```http
    GET /api/products?filter[category]=vehicle
    ```

### Price:

- Less than 990.00 EUR:

    ```http
    GET /api/products?filter[price]=<99000
    ```

- Equal to 990.00 EUR:

    ```http
    GET /api/products?filter[price]=99000
    ```

- Greater than 990.00 EUR:

    ```http
    GET /api/products?filter[price]=>99000
    ```

Filtering is implemented using [spatie/laravel-query-builder](https://spatie.be/docs/laravel-query-builder/v6/features/filtering).

## Design Patterns

### Chain of Responsibility
The discount rules applied to the products are implemented using the Chain of Responsibility behavioral design pattern. Each discount rule is encapsulated in its own handler class. These handlers are chained together and processed in sequence, applying the first applicable discount rule to the products.

This approach promotes the Open/Closed Principle, making it easy to add and remove discount rules.
