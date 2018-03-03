<?php

require_once './classes/Users.php';
$u    = new Users();
$item = $_REQUEST['item'];
$list = $u->add_new_manager(json_decode($item));
echo $list;