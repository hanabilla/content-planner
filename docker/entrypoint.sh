set -e

php artisan config:clear
php artisan migrate --force

exec "$@"