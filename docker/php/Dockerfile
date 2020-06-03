FROM php:7.3-fpm

RUN apt-get update && apt-get install -y git zip libzip-dev zlib1g zlib1g-dev locales sendmail wkhtmltopdf rsyslog
RUN docker-php-ext-install pdo_mysql opcache bcmath zip gettext

RUN sed -i -e 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen && \
    sed -i -e 's/# nl_NL.UTF-8 UTF-8/nl_NL.UTF-8 UTF-8/' /etc/locale.gen && \
    locale-gen

RUN sed -i 's/pm.max_children = .*$/pm.max_children = 10/' /usr/local/etc/php-fpm.d/www.conf

# Disable imklog for rsyslog, so we don't need privileges for this
RUN sed -i '/imklog/s/^/#/' /etc/rsyslog.conf

COPY php.ini "$PHP_INI_DIR/php.ini"

CMD /etc/init.d/rsyslog start && php-fpm