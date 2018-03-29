<?php

require_once '/htdocs/home/learningindrops.com/www/lms/custom/mailchimp/classes/Mailchimp.php';
$m = new Maim();
$m->send_mailchimp_campaigns();
