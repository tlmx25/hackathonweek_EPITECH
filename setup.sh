#!/bin/bash

docker compose up --build -d

if [[ "$1" == "--init" ]]; then
    docker exec -it backend_web bash -c "yes | php bin/console doctrine:database:create ; yes | php bin/console make:migration; yes | php bin/console doctrine:migrations:migrate; curl http://localhost:8000/init"
else
    echo "You can init the database using the --init."
    echo "./setup.sh --init"
fi
