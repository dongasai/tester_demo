
FROM php:7.0-apache


ENV REFRESH_DATE 2020年12月29日09:13:36

RUN apt-get update
RUN apt-get install -y vim wget zip zlib1g-dev

RUN docker-php-ext-install bcmath mbstring pdo pdo_mysql zip;docker-php-ext-enable pdo pdo_mysql;

RUN pecl install redis \
    && docker-php-ext-enable redis

RUN apt install -y libevent-dev libmemcached-dev \ 
	&& pecl install memcached \
    && docker-php-ext-enable memcached

# 安装composer 
RUN wget https://mirrors.aliyun.com/composer/composer.phar \
	&& mv composer.phar /usr/local/bin/composer \
	&& chmod +x /usr/local/bin/composer
# 安装多进程所需的几个扩展 进程控制,内存共享,消息队列,互斥锁
RUN docker-php-ext-install pcntl sysvshm sysvmsg sysvsem;docker-php-ext-enable pcntl sysvshm sysvmsg sysvsem;

RUN pecl install xdebug-2.8.1;docker-php-ext-enable xdebug

COPY 1.ini /usr/local/etc/php/

WORKDIR /var/www/html