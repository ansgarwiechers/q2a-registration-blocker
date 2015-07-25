<?php
    /*
        Question2Answer by Gideon Greenspan and contributors
        http://www.question2answer.org/

        File: qa-plugin/example-page/qa-example-page.php
        Description: Page module class for example page plugin


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

    return array(
        'settings_saved'                      => "Plugin Settings Saved",
        'activate_plugin'                     => "Activate this plugin",
        'banned_usernames'                    => "Banned Usernames",
        'banned_usernames_note'               => "Only Usernames names separated by comma (eg owner,stupid)",
        'banned_email_domains'                => "Banned Email Domains",
        'banned_email_domains_note'           => "Only Domain names separated by comma (eg xyz.com,some.com)",
        'dont_allow_ch_email'                 => "Dont Allow to change users email",
        'dont_allow_ch_handle'                => "Dont Allow to change users handle",
        'email_domain_not_allowed'            => "This domain is not allowed",
        'username_not_allowed'                => "This username is not allowed",
        'not_allowed_to_change_email'         => 'You are not allowed to change your email',
        'not_allowed_to_change_username'      => 'You are not allowed to change your username',
        'you_are_detected_as_spammer'         => 'You are detected as a spammer and Not allowed to register here. If you got this accidentally then contact Administrator',
    );


    /*
        Omit PHP closing tag to help avoid accidental output
    */