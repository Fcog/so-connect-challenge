# SO Connect backend challenge

[Challenge instructions](https://github.com/sowifi/backend-challenge)

App built with Laravel.

## Code sections:

- [Domain Objects](https://github.com/Fcog/so-connect-challenge/tree/master/src/domain)

- [Domain - App connection](https://github.com/Fcog/so-connect-challenge/blob/master/src/app/Providers/CoffeeMachineProvider.php)

- [Endpoints](https://github.com/Fcog/so-connect-challenge/blob/master/src/routes/api.php)

- [Endpoints Controller](https://github.com/Fcog/so-connect-challenge/blob/master/src/app/Http/Controllers/CoffeeMachineController.php)

- [Tests](https://github.com/Fcog/so-connect-challenge/tree/master/src/tests)

## Prerequisites
- Install Docker Desktop

## Getting started
- Build environment:

```docker-compose up -d --build```

- Access docker shell:

```docker-compose exec php /bin/bash```

- Install dependencies:

```composer install```

- Create DB table:

```php artisan migrate```

## Testing

- Access docker shell:

```docker-compose exec php /bin/bash```

- Run tests:

```php artisan test```

## Asumptions

- The state initializes with full standard containers.
- The espressos left count is calculated using the normal espresso quantities.

## Endpoints

| Endpoint            					   | Verb		| Path                       							|
|-----------------------------| ----------| ------------------------------------------------------|
| Get status				              | `GET`	| `http://localhost:8080/api/status`									|
| Make espresso 						        | `POST`	| `http://localhost:8080/api/make-espresso`						| 
| Make double espresso 						 | `POST`	| `http://localhost:8080/api/make-double-espresso`									|
