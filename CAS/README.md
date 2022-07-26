Central Authentication Service (CAS)
====================================

Opencast supports CAS in [a few different ways](https://docs.opencast.org/develop/admin/#configuration/security.cas/#authorization).  The docker compose file in this directory configures an OpenLDAP container, and a mock CAS container.  The CAS container accepts *any* user provided their password is the same as their username, even if the user is not defined in LDAP.  The LDAP container is pre-configured with three users.

LDAP Users
----------

The LDAP container is preconfigured with three Opencast users, and an admin user for queries.  The users and passwords are:

| Username | Password | Notes |
| -------- | -------- | ----- |
| admin    | admin    | Used for queries, is a default of the container image itself. |
| aadmin   | aadmin   | The Opencast admin user |
| iinstructor | iinstructor   | The Opencast instructor user |
| sstudent   | sstudent   | The Opencast regular user |

Note: While the CAS container will accept any user, they will not gain any useful Opencast roles and thus things likely won't work.


Testing with Opencast
---------------------

To test this configuration start the containers with `docker-compose up -d`, then apply the configuration changes.  Tested working files for Opencast 12 can be found in the `configs` directory.  A diff of the changes lives in the `configs.diff` file.  Apply one or the other, but not both!

Note: You still need to manually enable the `opencast-security-cas` feature in `etc/org.apache.karaf.features.cfg` prior to starting Opencast!

Developers
----------

When updating the configuration changes above please ensure the diff, and teh files match!
