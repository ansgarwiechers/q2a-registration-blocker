<?php

    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        header( 'Location: ../../' );
        exit;
    }

    class qas_ubl_opt
    {
        const PLUGIN_ACTIVE = 'qas_ubl_active';
        const SAVE_OPTIONS = 'qas_ubl_save_options';
        const BANNED_USERNAMES = 'qas_ubl_banned_usernames';
        const BANNED_EMAIL_DOMAINS = 'qas_ubl_banned_email_domains';
        const BAN_SPAM_IPS = 'qas_ubl_ban_anonymous_ips';
        const DONT_ALLOW_TO_CHANGE_EMAIL = 'qas_ubl_dont_allow_ch_email';
        const DONT_ALLOW_TO_CHANGE_HANDLE = 'qas_ubl_dont_allow_ch_handle';
    }