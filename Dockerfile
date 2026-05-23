FROM node:20-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json vite.config.js ./
COPY resources ./resources
COPY public ./public

RUN npm ci
RUN npm run build


FROM php:8.4-fpm

RUN set -eux; \
	apt-get update; \
	apt-get install -y --no-install-recommends \
		git \
		unzip \
		curl \
		libzip-dev \
		libonig-dev \
		libpng-dev \
		libjpeg62-turbo-dev \
		libfreetype6-dev; \
	docker-php-ext-configure gd --with-freetype --with-jpeg; \
	docker-php-ext-install -j"$(nproc)" \
		zip \
		pdo_mysql \
		gd \
		mbstring \
		bcmath; \
	rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

COPY --from=assets /app/public/build /var/www/public/build

RUN php -r "if (!extension_loaded('gd')) { fwrite(STDERR, 'ext-gd is not enabled\n'); exit(1); } echo 'ext-gd enabled\n';"

RUN composer install --no-dev -o

EXPOSE 10000

CMD sh -c "php artisan migrate --force && php artisan db:seed --force && php -S 0.0.0.0:${PORT:-10000} -t public server.php"