<?php

require_once './classes/Subscribers.php';
$s = new Subscribers();
$list = $s->get_subsribers_page();
echo $list;