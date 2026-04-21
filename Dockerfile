FROM docker.productsup.com/cde/cde-php-cli-base:8.3

COPY bin/ ./bin
COPY config/ ./config
COPY src/ ./src
COPY .env composer.json composer.lock ./

ARG COMPOSER_AUTH=local
RUN composer install --no-dev

CMD ["php", "bin/console"]
