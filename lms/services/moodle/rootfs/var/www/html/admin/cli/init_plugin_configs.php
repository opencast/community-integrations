<?php

define('CLI_SCRIPT', true);

require(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/clilib.php');
require_once($CFG->libdir . '/moodlelib.php');

$plugin_configs = array(
  'tool_opencast' => array(
    // Opencast Instances
    'ocinstances'   => '[{"id": 1, "name":"Default",  "isvisible": 1, "isdefault": 1}]',
    'apiurl_1'      => 'http://opencast.localtest.me',
    'apiusername_1' => 'moodle',
    'apipassword_1' => 'moodle',

    // Maintenance
    'maintenancemode_1' => 'Disable',

    // General settings
    'limituploadjobs_1'      => 10,
    'uploadworkflow_1'       => 'schedule-and-upload',
    'publishtoengage_1'      => 1,
    'deleteworkflow_1'       => 'delete',
    'uploadfileextensions_1' => '.aac,.aiff,.flac,.m4a,.mp3,.oga,.ogg,.wav,video,.3gp,.f4v,.flv,.fmp4,.m4v,.mov,.mp4,.mpeg,.mpg,.ogv,.qt,.ts,.webm',

    // Group and Series
    'series_name_1' => '[COURSENAME]',

    // Roles
    'workflow_roles_1' => 'republish-metadata',
    'roles_1'          => '[{ "rolename":  "ROLE_ADMIN",
                              "actions":   "read,write",
                              "permanent": 1 },
                            { "rolename":  "ROLE_GROUP_MOODLE",
                              "actions":   "read,write",
                              "permanent": 1 },
                            { "rolename":  "ROLE_OWNER_[USERNAME]",
                              "actions":   "read,write",
                              "permanent": 1 },
                            { "rolename":  "ROLE_USER_[USERNAME]",
                              "actions":   "read,write",
                              "permanent": 1 }]',
    'aclownerrole_1'   => 'ROLE_OWNER_[USERNAME]',

    // Event Metadata

    // Series Metadata

    // Appearance
    // Overview page
    'showpublicationchannels_1' => 0,

    // Additional features
    // Settings for the chunkuploader
    'uploadfilelimit_1'             => 5368709120, # 5GB
    'offerchunkuploadalternative_1' => 0,

    // Opencast studio integration
    'enable_opencast_studio_link_1'     => 1,
    'opencast_studio_baseurl_1'         => 'http://opencast.localtest.me',
    'show_opencast_studio_return_btn_1' => 1,

    // Opencast Editor integration
    'enable_opencast_editor_link_1' => 1,
    'editorbaseurl_1'               => 'http://opencast.localtest.me',
    'editorendpointurl_1'           => '/editor-ui/index.html?id=',

    // Engage player integration
    'engageurl_1' => 'http://opencast.localtest.me',

    // Notifications
    'eventstatusnotificationenabled_1'  => 1,
    'eventstatusnotificationdeletion_1' => 2,

    // Control episode visibility
    'aclcontrol_1'      => 0,
    'aclcontrolafter_1' => 0,
    'aclcontrolgroup_1' => 0,

    // Add Opencast Activity modules to courses
    'addactivityenabled_1'      => 1,
    'addactivityintro_1'        => 1,
    'addactivitysection_1'      => 1,
    'addactivityavailability_1' => 1,

    'addactivityepisodeenabled_1'      => 1,
    'addactivityepisodeintro_1'        => 1,
    'addactivityepisodesection_1'      => 1,
    'addactivityepisodeavailability_1' => 1,

    // Settings for Transcription

    // Live Status Update
    'liveupdatereloadtimeout_1' => 10,

    // Workflows Privacy Notice

    // Additional features
    'download_channel_1' => 'engage-player',
    'workflow_tags_1'    => 'archive',
    'support_email_1'    => 'admin@moodle.localtest.me',
    'termsofuse_1'       => '<p><strong>Be Nice!</strong></p>',

    // LTI module features
    // Add Opencast LTI series modules to courses
    'addltienabled_1' => 0,

    // Add Opencast LTI episode modules to courses
    'addltiepisodeenabled_1' => 0,

    // Import videos features
    // Import videos from other courses
    'importmode_1'                => 'acl',
    'duplicateworkflow_1'         => 'duplicate-event',
    'importvideosmanualenabled_1' => 1,

    // Shared settings
    'uploadtimeout'          => 500,
    'faileduploadretrylimit' => 5,
  ),

  'mod_opencast' => array(
    'channel_1'          => 'engage-player',
    'download_channel_1' => 'engage-player',
    'download_default_1' => 1,
  ),

  'block_opencast' => array(
    'limitvideos_1' => 5,
  ),

  'filter_opencast' => array(
    'episodeurl_1' => 'http://opencast.localtest.me/play/[EPISODEID]',
  ),
);

foreach ($plugin_configs as $plugin => $configs) {
  cli_writeln('');
  cli_writeln('Settings for '.$plugin);

  foreach ($configs as $key => $value) {
    cli_writeln('   '.$key.' = '.$value);
    set_config($key, $value, $plugin);
  }
}

filter_set_global_state('opencast', 1);

cli_writeln('Settings for repository_opencast');

$repository = new stdClass();
$repository->edit = 0;
$repository->new = 'opencast';
$repository->plugin = 'opencast';
$repository->typeid = 0;
$repository->contextid = 1;
$repository->name = 'Opencast videos';
$repository->opencast_instance = 1;
$repository->opencast_author = '';
$repository->opencast_channelid = 'engage-player';
$repository->opencast_thumbnailflavor = '';
$repository->opencast_thumbnailflavorfallback = '';
$repository->opencast_playerurl = 1;
$repository->opencast_videoflavor = '';
$repository->submitbutton = 'Save';
repository::create('opencast', 0, context_system::instance(), $repository);

exit(0);
