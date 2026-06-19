FROM php:8.4

RUN mkdir /app
WORKDIR /app
RUN apt-get update

COPY --from=composer:2.2 /usr/bin/composer /usr/local/bin/composer

EXPOSE 8000