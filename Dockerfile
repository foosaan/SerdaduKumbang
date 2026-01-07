FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files first
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copy package.json
COPY package*.json ./

# Install Node dependencies
RUN npm ci --only=production || npm install

# Copy application code
COPY . .

# Build assets
RUN npm run build || true

# Post-install composer scripts
RUN composer dump-autoload --optimize

# Set permissions
RUN chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Expose port
ENV PORT=8080
EXPOSE 8080

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:${PORT}/ || exit 1

# Start command
CMD php artisan migrate --force && \
    php artisan db:seed --force 2>/dev/null || true && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan serve --host=0.0.0.0 --port=${PORT}
