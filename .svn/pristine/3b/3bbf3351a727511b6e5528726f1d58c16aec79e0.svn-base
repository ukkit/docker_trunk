FROM php:7.4-fpm-alpine

RUN apk update && apk add bash \
    bash-doc \
    bash-completion

RUN docker-php-ext-install pdo pdo_mysql

# COPY crontab /etc/crontabs/root

CMD ["crond", "-f"]