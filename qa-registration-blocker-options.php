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

// don't allow this page to be requested directly from browser
if (!defined('QA_VERSION')) {
  header('Location: ../../');
  exit;
}

/*
  Whitelist mode affects only domain/subdomin matches, not full email adresses
  or usernames. Enabling whitelist mode inverts the logic for disallowing or
  allowing domains: instead of banning all listed domains and/or subdomains
  everything except the listed domains and/or subdomains is banned.
*/
class qas_ubl_opt {
  const PLUGIN_ACTIVE               = 'qas_ubl_active';
  const SAVE_OPTIONS                = 'qas_ubl_save_options';
  const BANNED_USERNAMES            = 'qas_ubl_banned_usernames';
  const BANNED_EMAIL_DOMAINS        = 'qas_ubl_banned_email_domains';
  const BANNED_EMAIL_ADDRESSES      = 'qas_ubl_banned_email_addresses';
  const WHITELIST_MODE              = 'qas_ubl_whitelist_mode';
  const DONT_ALLOW_TO_CHANGE_EMAIL  = 'qas_ubl_dont_allow_ch_email';
  const DONT_ALLOW_TO_CHANGE_HANDLE = 'qas_ubl_dont_allow_ch_handle';
}
