<?php

    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        header( 'Location: ../../' );
        exit;
    }

    return array(
        'settings_saved'                 => "Plugin Settings Saved",
        'activate_plugin'                => "Activate this plugin",
        'banned_usernames'               => "Banned Usernames",
        'banned_usernames_note'          => "Only Usernames names separated by comma (eg owner,stupid)",
        'banned_email_domains'           => "Banned Email Domains",
        'banned_email_domains_note'      => "Only Domain names separated by comma (eg xyz.com,some.com)",
        'ban_anonymous_ips'              => "Ban Spammer IP Addresses from Registration",
        'ban_anonymous_ips_note'         => "The spam IP address details will be taken from http://www.stopforumspam.com/ ",
        'dont_allow_ch_email'            => "Dont Allow to change users email",
        'dont_allow_ch_handle'           => "Dont Allow to change users handle",
        'email_domain_not_allowed'       => "This domain is not allowed",
        'username_not_allowed'           => "This username is not allowed",
        'not_allowed_to_change_email'    => 'You are not allowed to change your email',
        'not_allowed_to_change_username' => 'You are not allowed to change your username',
        'you_are_detected_as_spammer'    => 'You are detected as a spammer and Not allowed to register here',
    );


    /*
        Omit PHP closing tag to help avoid accidental output
    */