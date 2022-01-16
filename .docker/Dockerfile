FROM php:7.2.6-fpm-alpine3.6

RUN echo '175.111.0.1   kafka' >> /etc/hosts

RUN ln -fsn /usr/local/bin/php /usr/bin/php
RUN ln -fsn /usr/local/bin/php-config /usr/bin/php-config

ARG LIBRDKAFKA_GIT_SHA1=1f7417d4796e036b8c19f17373f8290ff5c7561f
RUN apk add --update --no-cache alpine-sdk bash python autoconf && \
  git clone -o ${LIBRDKAFKA_GIT_SHA1} https://github.com/edenhill/librdkafka.git /tmp/librdkafka && \
  cd /tmp/librdkafka/ && \
  ./configure && \
  make && \
  make install

# php-rdkafka should be compiled using the same php module as result we are passing
# --with-php-config /usr/local/bin/php-config
ARG PHPCONF_PATH=/usr/local/etc/php/conf.d
ARG RDKAFKA_PHP_GIT_SHA1=abd6b6add8e0b983c27245a59981a9a4b5389139
RUN apk add --update --no-cache pcre-dev && \
  pecl install rdkafka && \
  echo "extension=rdkafka.so" > ${PHPCONF_PATH}/rdkafka.ini

RUN apk --no-cache add \
    curl \
    nginx \
    supervisor

COPY nginx/nginx.conf /etc/nginx/nginx.conf

COPY supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Setup document root
RUN mkdir -p /var/www/html


# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nobody.nobody /var/www/html && \
  chown -R nobody.nobody /run && \
  chown -R nobody.nobody /var/lib/nginx && \
  chown -R nobody.nobody /var/log/nginx

# Switch to use a non-root user from here on
#USER nobody

# Add application
WORKDIR /var/www/html

EXPOSE 8080



CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]