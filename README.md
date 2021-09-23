# SRM-APP

## Frontend setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run start
```

### Compiles and minifies for production
```
npm run build
```

### Run your unit tests
```
npm run test:unit
```

### Lints and fixes files
```
npm run lint
```

### API URL
```
http://localhost/app/v1
```

### Customize configuration
This app runs on localhost port 9090, please change if there are conflicts with other services on your computer.



# SRM-APP

## Backend setup
```
composer install
```

## Run Docker
Set up .env with corresponding Docker credentials. App should run on localhost.
```
docker compose up
```

## Clear Cache
```
php artisan config:clear
```

## Run Migrations and Seeders from Docker Container
```
docker exec -it srm-app php artisan migrate --seed
```

## Generate API DOCS
```
php artisan l5-swagger:generate
```

### API DOCS
```
http://localhost/app/docs
```