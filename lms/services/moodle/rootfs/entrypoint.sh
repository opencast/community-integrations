#!/bin/bash

set -e

if [ ! -f /.initialized ]; then
  cd /var/www/html

  # Install Moodle
  php admin/cli/install.php \
    --wwwroot="$WWWROOT" \
    --dbtype=pgsql \
    --dbhost=moodle-db \
    --dbname=moodle \
    --dbuser=moodle \
    --dbpass=moodle \
    --fullname="Test Moodle" \
    --shortname="moodle" \
    --adminpass="$ADMINPASS" \
    --adminemail="admin@moodle.localtest.me" \
    --non-interactive \
    --agree-license \
    --allow-unstable

  chmod 644 config.php

  # Install plugins
  php admin/cli/init_plugin_configs.php

  # Create test course
  php admin/cli/restore_backup.php \
    --file=/var/backups/example.mbz \
    --categoryid=1

  echo "Wait for group 'MH_DEFAULT_ORG_EXTERNAL_APPLICATIONS'"
  while ! curl -sSLf "http://opencast.localtest.me/admin-ng/groups/MH_DEFAULT_ORG_EXTERNAL_APPLICATIONS" \
            --digest -u "opencast_system_account:CHANGE_ME" \
            -H "X-Requested-Auth: Digest" > /dev/null 2>&1; do
    echo waiting...
    sleep 2
  done
  echo "Group 'MH_DEFAULT_ORG_EXTERNAL_APPLICATIONS' now exists"

  while ! curl -sSLf -X POST "http://opencast.localtest.me/admin-ng/users" \
            --digest -u "opencast_system_account:CHANGE_ME" \
            -H "X-Requested-Auth: Digest" \
            -F "username=moodle" \
            -F "password=moodle" \
            -F "name=moodle" \
            -F "email=admin@moodle.localtest.me" \
            -F 'roles=[{"name": "ROLE_GROUP_MH_DEFAULT_ORG_EXTERNAL_APPLICATIONS", "type": "GROUP"},{"name": "ROLE_STUDIO", "type": "INTERNAL"}]'; do
    echo "User 'moodle' could not be created; trying again"
    sleep 5
  done
  echo "User 'moodle' created"

  touch /.initialized
fi

# Run Moodle
exec /usr/local/bin/apache2-foreground
