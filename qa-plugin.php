<?php

/*
	Plugin Name: Registration Blocker
	Plugin URI:
	Plugin Description: Blocks registration if the user detected as a spammer
	Plugin Version: 1.0
	Plugin Date: 2015-01-25
	Plugin Author: Amiya Sahu
	Plugin Author URI: http://www.amiyasahu.com/
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI:
*/


	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../../');
		exit;
	}

    if(!defined('QAS_U_BLOCKER_PLUGIN_DIR'))
        define('QAS_U_BLOCKER_PLUGIN_DIR', dirname(__FILE__));

    require_once QAS_U_BLOCKER_PLUGIN_DIR . '/qa-registration-blocker-options.php' ;

    qa_register_plugin_overrides('qa-registration-blocker-overrides.php');
    qa_register_plugin_module('filter', 'qa-registration-blocker.php', 'qas_registration_blocker', 'QA Registration Blocker' );
    qa_register_plugin_phrases('qa-registration-blocker-lang-*.php', 'qas_regb');


    /*
        Omit PHP closing tag to help avoid accidental output
    */