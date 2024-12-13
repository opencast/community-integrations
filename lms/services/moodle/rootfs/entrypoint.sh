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

  while ! curl -sSLf -X POST "http://opencast.localtest.me/admin-ng/groups" \
            --digest -u "opencast_system_account:CHANGE_ME" \
            -H "X-Requested-Auth: Digest" \
            -d "name=Moodle" \
            -d "roles=ROLE_SUDO,ROLE_API,ROLE_API_CAPTURE_AGENTS_VIEW,ROLE_API_EVENTS_ACL_DELETE,ROLE_API_EVENTS_ACL_EDIT,ROLE_API_EVENTS_ACL_VIEW,ROLE_API_EVENTS_CREATE,ROLE_API_EVENTS_DELETE,ROLE_API_EVENTS_EDIT,ROLE_API_EVENTS_MEDIA_VIEW,ROLE_API_EVENTS_METADATA_DELETE,ROLE_API_EVENTS_METADATA_EDIT,ROLE_API_EVENTS_METADATA_VIEW,ROLE_API_EVENTS_PUBLICATIONS_VIEW,ROLE_API_EVENTS_SCHEDULING_EDIT,ROLE_API_EVENTS_SCHEDULING_VIEW,ROLE_API_EVENTS_TRACK_EDIT,ROLE_API_EVENTS_VIEW,ROLE_API_GROUPS_CREATE,ROLE_API_GROUPS_DELETE,ROLE_API_GROUPS_EDIT,ROLE_API_GROUPS_VIEW,ROLE_API_LISTPROVIDERS_VIEW,ROLE_API_PLAYLISTS_CREATE,ROLE_API_PLAYLISTS_DELETE,ROLE_API_PLAYLISTS_EDIT,ROLE_API_PLAYLISTS_VIEW,ROLE_API_SECURITY_EDIT,ROLE_API_SERIES_ACL_EDIT,ROLE_API_SERIES_ACL_VIEW,ROLE_API_SERIES_CREATE,ROLE_API_SERIES_DELETE,ROLE_API_SERIES_EDIT,ROLE_API_SERIES_METADATA_DELETE,ROLE_API_SERIES_METADATA_EDIT,ROLE_API_SERIES_METADATA_VIEW,ROLE_API_SERIES_PROPERTIES_EDIT,ROLE_API_SERIES_PROPERTIES_VIEW,ROLE_API_SERIES_VIEW,ROLE_API_STATISTICS_VIEW,ROLE_API_WORKFLOW_DEFINITION_VIEW,ROLE_API_WORKFLOW_INSTANCE_CREATE,ROLE_API_WORKFLOW_INSTANCE_DELETE,ROLE_API_WORKFLOW_INSTANCE_EDIT,ROLE_API_WORKFLOW_INSTANCE_VIEW"; do
    echo "Group 'Moodle' could not be created; trying again"
    sleep 5
  done
  echo "Group 'Moodle' created"

  while ! curl -sSLf -X POST "http://opencast.localtest.me/admin-ng/users" \
            --digest -u "opencast_system_account:CHANGE_ME" \
            -H "X-Requested-Auth: Digest" \
            -F "username=moodle" \
            -F "password=moodle" \
            -F "name=moodle" \
            -F "email=admin@moodle.localtest.me" \
            -F 'roles=[{"name": "ROLE_GROUP_MOODLE", "type": "GROUP"},{"name": "ROLE_STUDIO", "type": "INTERNAL"}]'; do
    echo "User 'moodle' could not be created; trying again"
    sleep 5
  done
  echo "User 'moodle' created"

  touch /.initialized
fi

# Run Moodle
exec /usr/local/bin/apache2-foreground
