symfony server:start --no-tls --port=8080
yes | php bin/console doctrine:database:create
yes | php bin/console make:migration
yes | php bin/console doctrine:migrations:migrate
