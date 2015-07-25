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

    function qa_create_new_user( $email, $password, $handle, $level = QA_USER_LEVEL_BASIC, $confirmed = false )
    {

        if ( qa_opt( qas_ubl_opt::PLUGIN_ACTIVE ) && qa_opt( qas_ubl_opt::BAN_SPAM_IPS ) ) {

            require_once QAS_U_BLOCKER_PLUGIN_DIR . '/stopspamforum.php';
            $ip = qa_remote_ip_address();
            $sfs = new StopForumSpam();
            $args = array( 'email' => $email, 'ip' => $ip, 'username' => $handle );
            $is_spammer = $sfs->is_spammer( $args );
            if ( $is_spammer ) {
                qa_redirect('registration-blocked' , array('state'=>'show-error'));
            }
        }

        return qa_create_new_user_base( $email, $password, $handle, $level, $confirmed );
    }