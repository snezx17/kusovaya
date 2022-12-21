FROM php:7.4-apache
RUN docker-php-ext-install mysqli &&\
    docker-php-ext-enable mysqli
    
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install zip

RUN ["apt-get", "update"]
RUN ["apt-get", "install", "-y", "zip"]
RUN ["apt-get", "install", "-y", "unzip"]

#installing gd 
RUN apt-get update && \
apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
docker-php-ext-install gd



#installing composer
#COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
#CMD bash -c "composer require paquettg/php-html-parser"
#RUN { \
#    echo 'session.save_handler = redis'; \
#    echo 'session.save_path = tcp://localhost:3336'; \
#} >> /usr/local/etc/php/conf.d/docker-php-ext-redis.ini