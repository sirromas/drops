<?php

require_once './classes/Users.php';
$u    = new Users();
$list = $u->get_add_manager_dialog();
echo $list;