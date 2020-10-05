<?php

    /*
        This program is free software; you can redistribute it and/or
        modify it under the terms of the GNU General Public License
        as published by the Free Software Foundation; either version 2
        of the License, or (at your option) any later version.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        More about this license: http://www.question2answer.org/license.php
    */

    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        header( 'Location: ../../' );
        exit;
    }

    if ( !defined( 'QAS_U_BLOCKER_PLUGIN_DIR' ) )
        define( 'QAS_U_BLOCKER_PLUGIN_DIR', dirname( __FILE__ ) );

    require_once QAS_U_BLOCKER_PLUGIN_DIR . '/qa-registration-blocker-options.php';

    qa_register_plugin_module( 'filter', 'qa-registration-blocker.php', 'qas_registration_blocker', 'QA Registration Blocker' );
    qa_register_plugin_phrases( 'qa-registration-blocker-lang-*.php', 'qas_regb' );


    /*
        Omit PHP closing tag to help avoid accidental output
    */
