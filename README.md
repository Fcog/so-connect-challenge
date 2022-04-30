## Prerequisites
- Install Docker Desktop

## Getting started
- Build environment:

```docker-compose up -d --build```

- Bash into the environment:

```docker-compose exec php /bin/bash```

- Install dependencies:

```composer install```

- Create DB table:

```php artisan migrate```

## Asumptions

- The beans and water containers start full with the standard size.

## Endpoints

GET http://localhost:8080/api/status

POST http://localhost:8080/api/make-espresso

POST http://localhost:8080/api/make-double-espresso