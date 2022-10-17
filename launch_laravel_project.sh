#!/bin/sh
mkdir -p storage/framework/cache/data/
mkdir -p storage/framework/app/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

cp .env.example .env
if [[ "$OSTYPE" == "linux-gnu"* ]]; then
    sed -i "s/DB_HOST=127.0.0.1/DB_HOST=mysql/" .env
    sed -i "s/DB_USERNAME=root/DB_USERNAME=sail/" .env
    sed -i "s/DB_PASSWORD=/DB_PASSWORD=password/" .env
elif [[ "$OSTYPE" == "darwin"* ]]; then
        # Mac OSX
        # sed on Mac OSX is not GNU sed but BSD sed
    sed -i "" "s/DB_HOST=127.0.0.1/DB_HOST=mysql/" .env
    sed -i "" "s/DB_USERNAME=root/DB_USERNAME=sail/" .env
    sed -i "" "s/DB_PASSWORD=/DB_PASSWORD=password/" .env
elif [[ "$OSTYPE" == "cygwin" ]]; then
        # POSIX compatibility layer and Linux environment emulation for Windows
    echo "Your platform $OSTYPE is not supported by this script."
    exit 1
elif [[ "$OSTYPE" == "msys" ]]; then
        # Lightweight shell and GNU utilities compiled for Windows (part of MinGW)
    echo "Your platform $OSTYPE is not supported by this script."
    exit 1
elif [[ "$OSTYPE" == "win32" ]]; then
        # I'm not sure this can happen.
    echo "Your platform $OSTYPE is not supported by this script."
    exit 1
elif [[ "$OSTYPE" == "freebsd"* ]]; then
        # ...
    echo "Your platform $OSTYPE is not supported by this script."
    exit 1
else
        # Unknown.
    echo "Your platform $OSTYPE is not supported by this script."
    exit 1
fi

./vendor/bin/sail up -d
./vendor/bin/sail php artisan key:generate
./vendor/bin/sail php artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
./vendor/bin/sail down
