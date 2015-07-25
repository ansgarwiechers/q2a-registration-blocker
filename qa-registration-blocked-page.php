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

    class qa_registration_blocked
    {
        private $directory;
        private $urltoroot;


        public function load_module( $directory, $urltoroot )
        {
            $this->directory = $directory;
            $this->urltoroot = $urltoroot;
        }

        public function match_request( $request )
        {
            return $request == 'registration-blocked';
        }


        public function process_request( $request )
        {
            if ( qa_is_logged_in() ||
                !( qa_opt( qas_ubl_opt::PLUGIN_ACTIVE ) && qa_opt( qas_ubl_opt::BAN_SPAM_IPS ) )
            ) {
                qa_redirect( '' ); /*Dont allow logged in users to see this page*/
            }

            $qa_content = qa_content_prepare();

            $qa_content['title'] = qa_lang_html( 'qas_regb/registration_blocked' );

            if ( qa_get_state() == 'show-error' )
                $qa_content['error'] = qa_lang_html( 'qas_regb/you_are_detected_as_spammer' );

            $custom_message = qa_opt( qas_ubl_opt::CUSTOM_MSG_ON_BLOCKED_PAGE );

            if ( strlen( $custom_message ) )
                $qa_content['custom'] = $custom_message;

            return $qa_content;
        }
    }
