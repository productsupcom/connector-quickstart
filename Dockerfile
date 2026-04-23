FROM php:8.3-cli

RUN apt-get update && apt-get install -y unzip && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY bin/ ./bin
COPY config/ ./config
COPY src/ ./src
COPY .env composer.json composer.lock ./

RUN composer install --no-dev --no-interaction

CMD ["php", "bin/console"]
