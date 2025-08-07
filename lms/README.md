# Simple LMS Opencast Example

**NOTE: THIS IS NOT A PRODUCTION EXAMPLE!** Make sure to properly configure security measures.

This folder contains example Docker Compose files for starting Opencast and connected LMS applications. The Docker Compose services are divided into multiple Composefiles. Use the `-f` option to include the desired services.

## Opencast

You can access Opencast under <http://opencast.localtest.me/> with the user `admin` and the password `opencast`.

## Moodle

You can access Moodle under <http://moodle.localtest.me/> with the user `admin` and the password `moodle`. All plugins are already installed and configured for the Opencast instance. An example course with the Opencast block plugin is also already available.

Start Opencast and Moodle using the following command:

```sh
$ docker compose -f compose.yaml -f compose.moodle.yaml up
```

This example does not run Moodle cron jobs, which are used to upload files to Opencast. You may run all cron jobs using the following command:

```sh
$ docker compose -f compose.yaml -f compose.moodle.yaml exec -- moodle php admin/cli/cron.php
```

Alternatively, you may also run specific tasks, e.g. `process_upload_cron`:

```sh
$ docker compose -f compose.yaml -f compose.moodle.yaml exec -- moodle php admin/cli/scheduled_task.php '--execute=\tool_opencast\task\process_upload_cron'
```
