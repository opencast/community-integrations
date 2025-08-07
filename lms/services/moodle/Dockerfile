ARG MOODLE_PHP_APACHE=latest
FROM docker.io/moodlehq/moodle-php-apache:$MOODLE_PHP_APACHE

USER www-data

ARG MOODLE_VERSION=main
RUN git clone https://github.com/moodle/moodle.git /var/www/html \
 && cd /var/www/html \
 && git checkout "$MOODLE_VERSION"

ARG MOODLE_LOCAL_CHUNKUPLOAD=master
RUN git clone https://github.com/Opencast-Moodle/moodle-local_chunkupload.git /var/www/html/local/chunkupload \
 && cd /var/www/html/local/chunkupload \
 && git checkout "$MOODLE_LOCAL_CHUNKUPLOAD"

ARG MOODLE_REPOSITORY_OPENCAST=master
RUN git clone https://github.com/Opencast-Moodle/moodle-repository_opencast.git /var/www/html/repository/opencast \
 && cd /var/www/html/repository/opencast \
 && git checkout "$MOODLE_REPOSITORY_OPENCAST"

ARG MOODLE_FILTER_OPENCAST=master
RUN git clone https://github.com/Opencast-Moodle/moodle-filter_opencast.git /var/www/html/filter/opencast \
 && cd /var/www/html/filter/opencast \
 && git checkout "$MOODLE_FILTER_OPENCAST"

ARG MOODLE_TOOL_OPENCAST=master
RUN git clone https://github.com/Opencast-Moodle/moodle-tool_opencast.git /var/www/html/admin/tool/opencast \
 && cd /var/www/html/admin/tool/opencast \
 && git checkout "$MOODLE_TOOL_OPENCAST"

ARG MOODLE_MOD_OPENCAST=master
RUN git clone https://github.com/Opencast-Moodle/moodle-mod_opencast.git /var/www/html/mod/opencast \
 && cd /var/www/html/mod/opencast \
 && git checkout "$MOODLE_MOD_OPENCAST"

ARG MOODLE_BLOCK_OPENCAST=master
RUN git clone https://github.com/Opencast-Moodle/moodle-block_opencast.git /var/www/html/blocks/opencast \
 && cd /var/www/html/blocks/opencast \
 && git checkout "$MOODLE_BLOCK_OPENCAST"

USER root

# Disable Apache access log
RUN rm /etc/apache2/conf-enabled/other-vhosts-access-log.conf \
 && sed -i '/#*[Cc]ustom[Ll]og/d' /etc/apache2/sites-enabled/000-default.conf

COPY rootfs /

# Enable debugging
RUN docker-php-ext-enable xdebug \
 && sed -i 's/^; zend_extension=/zend_extension=/' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

CMD ["/entrypoint.sh"]
