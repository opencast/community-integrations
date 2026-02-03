# Simple Tobira Example

**NOTE: THIS IS NOT A PRODUCTION EXAMPLE!** Make sure to properly configure security measures.

This folder contains example Docker Compose files for starting Opencast and a connected Tobira.

You may need to build a Tobira container image locally before starting this Docker Compose example:

```sh
$ git clone https://github.com/elan-ev/tobira.git
$ ./x.sh build-container-image
```

## Opencast

You can access Opencast under <http://opencast.localtest.me/> with the user `admin` and the password `opencast`.

## Tobira

You can access Opencast under <http://localhost/> (`localhost` is required for non-TLS test site). All users created in Opencast can also log into Tobira, e.g. the user `admin` with the password `opencast`.

## Known Limitations

Tobira uses service workers which require TLS, i.e. a "secure origin". Accessing Tobira under http://tobira.localtest.me/ will therefore fail in browsers. However, Opencast currently uses this URL for internal communication to Tobira and may display links with this domain in the Opencast Admin UI. Future versions of this example could introduce a self-signed certificate that would eliminate this problem, but would introduce warnings about untrusted certificates in browsers.
