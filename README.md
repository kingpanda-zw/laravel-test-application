# Laravel Application TEst

This is Laravel application test

## Features

- Product Category Management
- Product Management
- Integrated with [Stripe](https://stripe.com/) Checkout.


## Installation
```bash
composer install
```

If your laravel application doesn't generate a key automatically, run the following command to generate your laravel application key
```bash
php artisan key:generate
```

## Environment variables
In your *.env* make sure your setup your variables

### Setup up database
* DB_DATABASE
* DB_USERNAME
* DB_PASSWORD

### Setup up MAIL
- MAIL_HOST
- MAIL_USERNAME
- MAIL_PASSWORD
- MAIL_ENCRYPTION

### Setup Stripe Keys
- STRIPE_KEY
- STRIPE_SECRET

## Create your database tables
```bash
php artisan migrate
```

## Create default user

You need to create the default user for you to use the backend
Run the following command

```bash
php artisan db:seed
```

The default credentials are *admin@admin.com* and *password*


## Running the Application
```bash
php artisan serve
```

## Running your queue worker
```bash
php artisan queue:worker
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)