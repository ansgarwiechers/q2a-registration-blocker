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

return array(
  'settings_saved'                 => "Plugin Settings Saved",
  'activate_plugin'                => "Activate this plugin",
  'banned_usernames'               => "Banned Usernames",
  'banned_usernames_note'          => "Only usernames separated by comma (eg owner,stupid)",
  'banned_email_domains'           => "Email Domains",
  'banned_email_domains_note'      => "Only domain names separated by comma (eg example.org,example.com). To ban subdomains of a domain add a the domain name with a leading dot (eg .example.org)",
  'whitelist_mode'                 => 'Whitelist Email Domains',
  'whitelist_mode_note'            => 'Allow only listed domains/subdomains and ban everything else (default behavior is to ban all listed domains/subdomains)',
  'banned_email_addresses'         => "Banned Email Addresses",
  'banned_email_addresses_note'    => "Only email addresses separated by comma (eg some@example.org,other@example.com)",
  'banned_email_regex'             => "Banned Email Address Patterns",
  'banned_email_regex_note'        => "List of regular expressions to match banned e-mail addresses (one pattern per line, no separating commas, all expressions are case-insensitive)",
  'dont_allow_ch_email'            => "Don't allow to change users email",
  'dont_allow_ch_handle'           => "Don't allow to change users handle",
  'email_domain_not_allowed'       => "This domain is not allowed",
  'email_address_not_allowed'      => "This email address is not allowed",
  'username_not_allowed'           => "This username is not allowed",
  'not_allowed_to_change_email'    => 'You are not allowed to change your email',
  'not_allowed_to_change_username' => 'You are not allowed to change your username',
);
