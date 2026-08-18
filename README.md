# Product Rating API

Simple Laravel + Sanctum API where authenticated users rate products (1–5),
change their rating, remove it, and list products with average rating,
their own rating, and an "active/inactive" freshness flag.

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan sanctum:install   # publishes sanctum migration (if not already present)
php artisan migrate --seed
php artisan serve --port=4321
```

> Note: this project was generated as a lean Laravel skeleton (no `vendor/`,
> since this build environment has no internet access to Packagist). Running
> `composer install` against a fresh Laravel 11 install will pull in the
> framework + Sanctum and everything above will work as-is.

Seeded users (password for all: `QAZzaq123`):
- young@test.com
- willy@test.com
- sadiki@test.com

Seeded products (10 items): Wireless Mouse, Mechanical Keyboard, USB-C Hub, Laptop Stand, Webcam 1080p, Noise Cancelling Headphones, 27-inch 4K Monitor, Ergonomic Office Chair, Portable SSD 1TB, Desk Mat XXL.

## Auth

All endpoints require a Sanctum bearer token, except `/api/login`.

```bash
curl -X POST http://localhost:4321/api/login \
  -H "Accept: application/json" \
  -d "email=young@test.com" -d "password=QAZzaq123"
```

Response returns `token` — send it as `Authorization: Bearer {token}` on every other call.

## Endpoints

| Method | URL                        | Description                              |
|--------|----------------------------|-------------------------------------------|
| POST   | /api/login                 | Login, returns token                      |
| POST   | /api/logout                | Revoke current token                      |
| GET    | /api/products               | List products + ratings + user_rating + time_passed + active_time |
| POST   | /api/products/{id}/rate     | Rate a product (fails if already rated)   |
| PUT    | /api/products/{id}/rate     | Change an existing rating                 |
| DELETE | /api/products/{id}/rate     | Remove your rating                        |
| POST   | /api/patient-registration   | (Bonus Task) Register patient with Gpitg Hospital |

### Rate a product
```bash
curl -X POST http://localhost:4321/api/products/1/rate \
  -H "Authorization: Bearer {token}" -H "Accept: application/json" \
  -d "rating=4"
```

### Change a rating
```bash
curl -X PUT http://localhost:4321/api/products/1/rate \
  -H "Authorization: Bearer {token}" -H "Accept: application/json" \
  -d "rating=5"
```

### Remove a rating
```bash
curl -X DELETE http://localhost:4321/api/products/1/rate \
  -H "Authorization: Bearer {token}" -H "Accept: application/json"
```

### List products
```bash
curl http://localhost:4321/api/products \
  -H "Authorization: Bearer {token}" -H "Accept: application/json"
```

Each product includes:
- `ratings` — average of all users' ratings for that product
- `user_rating` — the logged-in user's own rating (null if they haven't rated it)
- `time_passed` — minutes since the user rated it (null if not rated)
- `active_time` — `"active"` if `time_passed > 30`, else `"inactive"` (null if not rated)

### (Bonus Task) Register a Patient with Gpitg Hospital
```bash
curl -X POST http://localhost:4321/api/patient-registration \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "Sponsor_ID": "1",
    "Patient_Name": "ngenzi ngenzi",
    "Date_Of_Birth": "2022-07-02",
    "Gender": "Male",
    "Visit_Type_ID": "1",
    "Type_Of_Check_In": "1",
    "branchId": "1",
    "Employee_ID": "46",
    "pf3": null,
    "Diceased": "no",
    "Referral_Status": null
  }'
```

Response returns `message` and `Check_In_Date_And_Time`.

## Business rules implemented

- A user can only have one rating per product — enforced both by a DB unique
  constraint (`user_id`, `product_id` in `user_ratings`) and in
  `RatingController@rate`, which returns `409` if a rating already exists.
- Rating value is validated to be an integer between 1 and 5 (`RateProductRequest`).
- Every route except `/api/login` is protected by the `auth:sanctum` middleware.

## Project structure

```
app/Models/User.php
app/Models/Product.php
app/Models/UserRating.php
app/Http/Controllers/Api/AuthController.php
app/Http/Controllers/Api/RatingController.php
app/Http/Requests/RateProductRequest.php
database/migrations/2024_01_01_000001_create_products_table.php
database/migrations/2024_01_01_000002_create_user_ratings_table.php
database/seeders/UserSeeder.php
database/seeders/ProductSeeder.php
database/seeders/DatabaseSeeder.php
routes/api.php
```

## Candidate Information

- **Name**: Young William SADIKI
- **Email**: mrsadikiy@gmail.com
- **Phone**: 0617065852

