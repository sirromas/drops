<?php

require_once './classes/Promotion.php';
$p    = new Promotion();
$list = $p->get_promotion_page();
echo $list;