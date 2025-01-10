<?php

define('CLI_SCRIPT', true);

require(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/clilib.php');
require_once($CFG->libdir . '/moodlelib.php');


cli_writeln('Settings for tool_opencast');

set_config('ocinstances',   '[{"id": 1, "name":"Default",  "isvisible": 1, "isdefault": 1}]', 'tool_opencast');
set_config('apiurl_1',      'http://opencast.localtest.me',                                   'tool_opencast');
set_config('apiusername_1', 'moodle',                                                         'tool_opencast');
set_config('apipassword_1', 'moodle',                                                         'tool_opencast');



cli_writeln('Settings for mod_opencast');

set_config('channel_1',          'engage-player', 'mod_opencast');
set_config('download_channel_1', 'engage-player', 'mod_opencast');
set_config('download_default_1', 1,               'mod_opencast');



cli_writeln('Settings for block_opencast');

set_config('limituploadjobs_1',                  10,                                 'block_opencast');
set_config('uploadworkflow_1',                   'schedule-and-upload',              'block_opencast');
set_config('publishtoengage_1',                  1,                                  'block_opencast');
set_config('ingestupload_1',                     0,                                  'block_opencast');
set_config('deleteworkflow_1',                   'delete',                           'block_opencast');
set_config('uploadfileextensions_1',             '.aac,.aiff,.flac,.m4a,.mp3,.oga,.ogg,.wav,video,.3gp,.f4v,.flv,.fmp4,.m4v,.mov,.mp4,.mpeg,.mpg,.ogv,.qt,.ts,.webm', 'block_opencast');
set_config('batchuploadenabled_1',               1,                                  'block_opencast');
set_config('group_creation_1',                   0,                                  'block_opencast');
set_config('series_name_1',                      '[COURSENAME]',                     'block_opencast');
set_config('workflow_roles_1',                   'republish-metadata',               'block_opencast');
set_config('roles_1',                            '[{ "rolename":  "ROLE_ADMIN",
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
                                                     "permanent": 1 }]',             'block_opencast');
set_config('aclownerrole_1',                     'ROLE_OWNER_[USERNAME]',            'block_opencast');
set_config('showpublicationchannels_1',          0,                                  'block_opencast');
set_config('showenddate_1',                      1,                                  'block_opencast');
set_config('showlocation_1',                     1,                                  'block_opencast');
set_config('enablechunkupload_1',                1,                                  'block_opencast');
set_config('uploadfilelimit_1',                  5368709120,                         'block_opencast');
set_config('offerchunkuploadalternative_1',      0,                                  'block_opencast');
set_config('enable_opencast_studio_link_1',      1,                                  'block_opencast');
set_config('open_studio_in_new_tab_1',           1,                                  'block_opencast');
set_config('opencast_studio_baseurl_1',          'http://opencast.localtest.me',     'block_opencast');
set_config('show_opencast_studio_return_btn_1',  1,                                  'block_opencast');
set_config('enable_opencast_editor_link_1',      1,                                  'block_opencast');
set_config('editorbaseurl_1',                    'http://opencast.localtest.me',     'block_opencast');
set_config('editorendpointurl_1',                '/editor-ui/index.html?id=',        'block_opencast');
set_config('eventstatusnotificationenabled_1',   1,                                  'block_opencast');
set_config('eventstatusnotificationdeletion_1',  2,                                  'block_opencast');
set_config('aclcontrol_1',                       0,                                  'block_opencast');
set_config('aclcontrolafter_1',                  0,                                  'block_opencast');
set_config('aclcontrolgroup_1',                  0,                                  'block_opencast');
set_config('addactivityenabled_1',               1,                                  'block_opencast');
set_config('addactivityintro_1',                 1,                                  'block_opencast');
set_config('addactivitysection_1',               1,                                  'block_opencast');
set_config('addactivityavailability_1',          1,                                  'block_opencast');
set_config('addactivityepisodeenabled_1',        1,                                  'block_opencast');
set_config('addactivityepisodeintro_1',          1,                                  'block_opencast');
set_config('addactivityepisodesection_1',        1,                                  'block_opencast');
set_config('addactivityepisodeavailability_1',   1,                                  'block_opencast');
# TODO: Transcriptions
set_config('liveupdateenabled_1',                1,                                  'block_opencast');
set_config('download_channel_1',                 'engage-player',                    'block_opencast');
# TODO: direct_access_channel_1?
set_config('workflow_tag_1',                     'archive',                          'block_opencast');
set_config('support_email_1',                    'admin@moodle.localtest.me',        'block_opencast');
set_config('termsofuse_1',                       '<p><strong>Be Nice!</strong></p>', 'block_opencast');
set_config('addltienabled_1',                    0,                                  'block_opencast');
set_config('addltiepisodeenabled_1',             0,                                  'block_opencast');
set_config('importvideosenabled_1',              1,                                  'block_opencast');
set_config('importmode_1',                       'acl',                              'block_opencast');
set_config('importvideoscoreenabled_1',          1,                                  'block_opencast');
set_config('importvideoscoredefaultvalue_1',     'Checked',                          'block_opencast');
set_config('importvideosmanualenabled_1',        1,                                  'block_opencast');
set_config('importvideoshandleseriesenabled_1',  0,                                  'block_opencast');
set_config('importvideoshandleepisodeenabled_1', 0,                                  'block_opencast');



cli_writeln('Settings for repository_opencast');

$repository = new stdClass();
$repository->edit = 0;
$repository->new = "opencast";
$repository->plugin = "opencast";
$repository->typeid = 0;
$repository->contextid = 1;
$repository->name = "Opencast videos";
$repository->opencast_instance = 1;
$repository->opencast_author = "";
$repository->opencast_channelid = "engage-player";
$repository->opencast_thumbnailflavor = "";
$repository->opencast_thumbnailflavorfallback = "";
$repository->opencast_playerurl = 1;
$repository->opencast_videoflavor = "";
$repository->submitbutton = "Save";
repository::create('opencast', 0, context_system::instance(), $repository);



cli_writeln('Settings for filter_opencast');

filter_set_global_state("opencast", 1);
set_config('episodeurl_1', 'http://opencast.localtest.me/play/[EPISODEID]', 'filter_opencast');

exit(0);
