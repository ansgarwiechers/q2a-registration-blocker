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

class qas_registration_blocker {

  public function option_default($option) {
    switch ($option) {
      case qas_ubl_opt::PLUGIN_ACTIVE :
        return 1;
      default :
        return null;
    }
  }

  public function admin_form(&$qa_content) {
    $saved = false;

    if (qa_clicked(qas_ubl_opt::SAVE_OPTIONS)) {
      qa_opt(qas_ubl_opt::PLUGIN_ACTIVE, (int) qa_post_text(qas_ubl_opt::PLUGIN_ACTIVE));
      qa_opt(qas_ubl_opt::BANNED_USERNAMES, qa_post_text(qas_ubl_opt::BANNED_USERNAMES));
      qa_opt(qas_ubl_opt::BANNED_EMAIL_DOMAINS, qa_post_text(qas_ubl_opt::BANNED_EMAIL_DOMAINS));
      qa_opt(qas_ubl_opt::WHITELIST_MODE, (int) qa_post_text(qas_ubl_opt::WHITELIST_MODE));
      qa_opt(qas_ubl_opt::BANNED_EMAIL_ADDRESSES, qa_post_text(qas_ubl_opt::BANNED_EMAIL_ADDRESSES));
      qa_opt(qas_ubl_opt::DONT_ALLOW_TO_CHANGE_EMAIL, (int) qa_post_text(qas_ubl_opt::DONT_ALLOW_TO_CHANGE_EMAIL));
      qa_opt(qas_ubl_opt::DONT_ALLOW_TO_CHANGE_HANDLE, (int) qa_post_text(qas_ubl_opt::DONT_ALLOW_TO_CHANGE_HANDLE));
      $saved = true;
    }

    qa_set_display_rules($qa_content, array(
      qas_ubl_opt::BANNED_USERNAMES            => qas_ubl_opt::PLUGIN_ACTIVE,
      qas_ubl_opt::BANNED_EMAIL_DOMAINS        => qas_ubl_opt::PLUGIN_ACTIVE,
      qas_ubl_opt::WHITELIST_MODE              => qas_ubl_opt::PLUGIN_ACTIVE,
      qas_ubl_opt::BANNED_EMAIL_ADDRESSES      => qas_ubl_opt::PLUGIN_ACTIVE,
      qas_ubl_opt::DONT_ALLOW_TO_CHANGE_EMAIL  => qas_ubl_opt::PLUGIN_ACTIVE,
      qas_ubl_opt::DONT_ALLOW_TO_CHANGE_HANDLE => qas_ubl_opt::PLUGIN_ACTIVE,
    ));

    $fields = array_merge(
      $this->get_activate_form_elem(),
      $this->get_banned_username_field(),
      $this->get_banned_email_domain_field(),
      $this->get_whitelist_mode(),
      $this->get_banned_email_address_field(),
      $this->get_dont_allow_email_field_change(),
      $this->get_dont_allow_handle_field_change()
    );

    return array(
      'ok'      => ($saved && !isset($error)) ? $this->translate('settings_saved') : null,
      'fields'  => $fields,
      'buttons' => $this->get_buttons(),
    );
  }

  public function filter_email(&$email, $olduser) {
    $whitelist_mode = qa_opt(qas_ubl_opt::WHITELIST_MODE);

    $banned_emails  = explode(',', qa_opt(qas_ubl_opt::BANNED_EMAIL_ADDRESSES));
    $banned_emails  = array_map('trim', $banned_emails);

    $all_domains    = explode(',', qa_opt(qas_ubl_opt::BANNED_EMAIL_DOMAINS));
    $all_domains    = array_map('trim', $all_domains);
    $topdomains     = Array();
    $subdomains     = Array();

    foreach ($all_domains as $domain) {
      if (substr($domain, 0, 1) === '.') {
        $subdomains[] = $domain;
      } else {
        $topdomains[] = $domain;
      }
    }

    if (in_array($email, $banned_emails)) {
      return $this->translate('email_address_not_allowed');
    }

    $email_domain = $this->get_domain_from_email($email);

    if ($whitelist_mode) {
      if (!(in_array($email_domain, $topdomains) or $this->ends_with_any($email_domain, $subdomains))) {
        return $this->translate('email_domain_not_allowed');
      }
    } else {
      if (in_array($email_domain, $topdomains)) {
        return $this->translate('email_domain_not_allowed');
      }
      if ($this->ends_with_any($email_domain, $subdomains)) {
        return $this->translate('email_domain_not_allowed');
      }
    }

    if (qa_opt(qas_ubl_opt::DONT_ALLOW_TO_CHANGE_EMAIL) && isset($olduser) && qa_get_logged_in_level() < QA_USER_LEVEL_EXPERT) {
      return $this->translate('not_allowed_to_change_email');
    }
  }

  public function filter_handle(&$handle, $olduser) {
    $banned_usernames = explode(',', qa_opt(qas_ubl_opt::BANNED_USERNAMES));
    $banned_usernames = array_map('trim', $banned_usernames);

    if (in_array($handle, $banned_usernames)) {
      return $this->translate('username_not_allowed');
    }

    if (qa_opt(qas_ubl_opt::DONT_ALLOW_TO_CHANGE_HANDLE) && isset($olduser) && qa_get_logged_in_level() < QA_USER_LEVEL_EXPERT) {
      return $this->translate('not_allowed_to_change_username');
    }
  }

  private function validate_post_email(&$errors, $post) {
    if (@$post['notify'] && strlen(@$post['email'])) {
      $error = $this->filter_email($post['email'], null);
      if (isset($error)) {
        $errors['email'] = $error;
      }
    }
  }

  private function get_domain_from_email($email) {
    return substr(strrchr($email, "@"), 1);
  }

  private function translate($indentifier) {
    return qa_lang_html('qas_regb/' . $indentifier);
  }

  private function get_buttons() {
    return array(array(
      'label' => qa_lang_html('admin/save_options_button'),
      'tags'  => 'name="' . qas_ubl_opt::SAVE_OPTIONS . '"',
    ));
  }

  private function get_activate_form_elem() {
    return array(array(
      'label' => $this->translate('activate_plugin'),
      'tags'  => 'name="' . qas_ubl_opt::PLUGIN_ACTIVE . '" id="' . qas_ubl_opt::PLUGIN_ACTIVE . '"',
      'value' => qa_opt(qas_ubl_opt::PLUGIN_ACTIVE),
      'type'  => 'checkbox',
    ));
  }

  private function get_whitelist_mode() {
    return array(array(
      'id'    => qas_ubl_opt::WHITELIST_MODE,
      'label' => $this->translate('whitelist_mode'),
      'note'  => $this->translate('whitelist_mode_note'),
      'tags'  => 'name="' . qas_ubl_opt::WHITELIST_MODE . '"',
      'value' => qa_opt(qas_ubl_opt::WHITELIST_MODE),
      'type'  => 'checkbox',
    ));
  }

  private function get_dont_allow_email_field_change() {
    return array(array(
      'id'    => qas_ubl_opt::DONT_ALLOW_TO_CHANGE_EMAIL,
      'label' => $this->translate('dont_allow_ch_email'),
      'tags'  => 'name="' . qas_ubl_opt::DONT_ALLOW_TO_CHANGE_EMAIL . '"',
      'value' => qa_opt(qas_ubl_opt::DONT_ALLOW_TO_CHANGE_EMAIL),
      'type'  => 'checkbox',
    ));
  }

  private function get_dont_allow_handle_field_change() {
    return array(array(
      'id'    => qas_ubl_opt::DONT_ALLOW_TO_CHANGE_HANDLE,
      'label' => $this->translate('dont_allow_ch_handle'),
      'tags'  => 'name="' . qas_ubl_opt::DONT_ALLOW_TO_CHANGE_HANDLE . '"',
      'value' => qa_opt(qas_ubl_opt::DONT_ALLOW_TO_CHANGE_HANDLE),
      'type'  => 'checkbox',
    ));
  }

  private function get_banned_username_field() {
    return array(array(
      'id'    => qas_ubl_opt::BANNED_USERNAMES,
      'label' => $this->translate('banned_usernames'),
      'note'  => $this->translate('banned_usernames_note'),
      'tags'  => 'name="' . qas_ubl_opt::BANNED_USERNAMES . '"',
      'value' => qa_opt(qas_ubl_opt::BANNED_USERNAMES),
      'type'  => 'textarea',
      'rows'  => 10,
    ));
  }

  private function get_banned_email_domain_field() {
    return array(array(
      'id'    => qas_ubl_opt::BANNED_EMAIL_DOMAINS,
      'label' => $this->translate('banned_email_domains'),
      'note'  => $this->translate('banned_email_domains_note'),
      'tags'  => 'name="' . qas_ubl_opt::BANNED_EMAIL_DOMAINS . '"',
      'value' => qa_opt(qas_ubl_opt::BANNED_EMAIL_DOMAINS),
      'type'  => 'textarea',
      'rows'  => 10,
    ));
  }

  private function get_banned_email_address_field() {
    return array(array(
      'id'    => qas_ubl_opt::BANNED_EMAIL_ADDRESSES,
      'label' => $this->translate('banned_email_addresses'),
      'note'  => $this->translate('banned_email_addresses_note'),
      'tags'  => 'name="' . qas_ubl_opt::BANNED_EMAIL_ADDRESSES . '"',
      'value' => qa_opt(qas_ubl_opt::BANNED_EMAIL_ADDRESSES),
      'type'  => 'textarea',
      'rows'  => 10,
    ));
  }

  private function ends_with_any($str, $matches) {
    foreach ($matches as $match) {
      $length = strlen($match);
      if ($length == 0 or substr($str, -$length) === $match) {
        return true;
      }
    }
    return false;
  }

}
