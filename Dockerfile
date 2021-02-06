FROM php:7-alpine
WORKDIR /var/www
COPY . .
RUN ./composer.phar install --no-plugins --no-scripts
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
