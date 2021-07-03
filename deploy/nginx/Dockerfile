FROM nginx:alpine

ENV DATA_ROOT /data

WORKDIR ${DATA_ROOT}
# RUN set -x ; \
#   addgroup -g 82 -S www-data ; \
#   adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

# RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN mkdir -p ${DATA_ROOT}/public

