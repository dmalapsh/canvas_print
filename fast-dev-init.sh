cp docker-compose.developer.yml docker-compose.yml
cp .env.example .env
cp docker/php-fpm/php.ini.dev.example docker/php-fpm/php.ini
docker-compose up -d
docker-compose exec web composer i
docker-compose exec web npm i
docker-compose exec web php artisan migrate --seed
docker-compose exec web php artisan jwt:secret
docker-compose exec web php artisan key:generate
docker-compose exec -d web php artisan serve --host=0.0.0.0 --port=8000

echo "Раскоментируй command: php artisan serve --host=0.0.0.0 --port=8000 в docker-compose.yml"
