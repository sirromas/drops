<?php

require_once './classes/Contact.php';
$c = new Contact();
$list = $c->get_edit_page();
echo $list;