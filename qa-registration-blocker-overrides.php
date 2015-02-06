<?php

    function qa_create_new_user($email, $password, $handle, $level=QA_USER_LEVEL_BASIC, $confirmed=false){

        if( qa_opt(qas_ubl_opt::PLUGIN_ACTIVE) && qa_opt(qas_ubl_opt::BAN_SPAM_IPS)){

            require_once QAS_U_BLOCKER_PLUGIN_DIR . '/stopspamforum.php' ;
            $ip = qa_remote_ip_address();
            $sfs = new StopForumSpam();
            $args = array('email' => $email , 'ip' => $ip , 'username' => $handle );
            $is_spammer = $sfs->is_spammer( $args );
            if($is_spammer) {
                qa_fatal_error(qa_lang_html('qas_regb/you_are_detected_as_spammer'));
            }
        }

        qa_create_new_user_base($email, $password, $handle, $level, $confirmed);
    }