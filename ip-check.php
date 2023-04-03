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
override qa_is_ip_blocked() to include IP RBL checks

NOTE: This check runs with relatively high frequency, so make sure DNS queries
			go either against a caching resolver (to take the load off remote RBL
			servers) or against a locally hosted RBL.
*/
function qa_is_ip_blocked() {
  $qas_ubl_ip_is_blocked = qa_is_ip_blocked_base();
  if (!$qas_ubl_ip_is_blocked) {
  	$client_ip   = qa_remote_ip_address();
  	$ip_reversed = implode('.', array_reverse(explode('.', $client_ip)));
    $ipbl        = array_filter(explode("\n", qa_opt(qas_ubl_opt::IPBL)), function($val) {return !is_null($val) and $val != '';});
    foreach ($ipbl as $bl) {
      if (preg_match('/^127\.0\.0\.[0-9]+$/', gethostbyname("${ip_reversed}.${bl}"))) {
        $qas_ubl_ip_is_blocked = true;
				break;
      }
    }
	}
	return $qas_ubl_ip_is_blocked;
}
