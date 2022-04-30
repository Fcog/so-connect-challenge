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

## Asumptions

- The state initiallizes with the standard containers full.
- The espressos left count is calculated using the normal espresso quantities.

## Endpoints

| Endpoint            					   | Verb		| Path                       							|							|
|-----------------------------| ----------| ------------------------------------------------------| --------------------------|
| Get status				              | `GET`	| `http://localhost:8080/api/status`									|
| Make espresso 						        | `POST`	| `http://localhost:8080/api/make-espresso`						| 
| Make double espresso 						 | `POST`	| `http://localhost:8080/api/make-double-espresso`									|


## Testing:

- Access docker shell:

```docker-compose exec php /bin/bash```

- Run tests:

```php artisan test```