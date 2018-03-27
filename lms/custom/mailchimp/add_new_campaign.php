<?php

require_once './classes/Promotion.php';
$p    = new Promotion();
$item = $_REQUEST['item'];
$p->add_new_campaign(json_decode($item));
