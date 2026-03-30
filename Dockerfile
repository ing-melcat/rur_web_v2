FROM php:8.2-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends libcurl4-openssl-dev ca-certificates \
    && docker-php-ext-install pdo_mysql curl opcache \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app
COPY . /app

ENV PORT=8080 \
    APP_ENV=production

EXPOSE 8080

CMD ["sh", "-lc", "php -d variables_order=EGPCS -S 0.0.0.0:${PORT:-8080} -t /app /app/router.php"]
