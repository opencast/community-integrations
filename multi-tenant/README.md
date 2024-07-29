# Simple Multi-Tenant Opencast Example

This example shows a simple multi-tenant Opencast setup. It relies on the [*.localtest.me](https://readme.localtest.me/) service that resolves any subdomain to `127.0.0.1`. Make sure your local DNS server allows to resolve public domains to loopback addresses.

The following tenants exist:

| Tenant ID      | Tenant Name | Tenant URL                    |
| -------------- | ----------- | ----------------------------- |
| mh_default_org | Default     | http://default.localtest.me/  |
| tenant-a       | Tenant A    | http://tenant-a.localtest.me/ |
| tenant-b       | Tenant B    | http://tenant-b.localtest.me/ |

All static files are served on `cdn.localtest.me` by nginx (which also acts as reverse proxy for Opencast in general).

This example assumes port 80 can be used by Docker. Als note that Opencast will be started with debugging support on port 5005.

**!!! THIS IS NOT A CONFIGURATION FOR PRODUCTION USE !!!**

## Public Images

Using the publicly available images, you can simply start up the setup using Docker compose:

```sh
$ docker compose up
```

## Bring your own code

If you have compiled a development distribution of Opencast on your host machine (using `-Pdev`), you can run this compiled version with the `docker-compose.dev.yaml` variation. Use the following commands to point to the Opencast source folder and start up the containers:

```sh
$ export OPENCAST_SRC="/path/to/my/opencast/src/root/folder"
$ docker-compose -f docker-compose.yaml -f docker-compose.dev.yaml up
```
