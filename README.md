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





## Backend setup
```
composer install
```

## Run Docker
Set up .env with corresponding Docker credentials. App should run on localhost.
```
docker compose up
```

## Publish Cloudinary Package
Files are uploaded using the Cloudinary service, publish the package after running a "composer install".
```
php artisan vendor:publish --provider="CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider" --tag="cloudinary-laravel-config"
```

## Clear Cache
```
php artisan config:clear
```

## Run Migrations and Seeders from Docker Container
```
docker exec -it srm-app php artisan migrate --seed
```

## Run Unit Tests
```
docker exec -it srm-app php artisan test
```

## Generate API DOCS
```
php artisan l5-swagger:generate
```

### API DOCS
```
http://localhost/app/docs
```
