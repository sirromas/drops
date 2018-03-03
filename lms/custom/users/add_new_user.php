<?php

require_once './classes/Users.php';
$u    = new Users();
$list = $u->get_add_new_user_dialog();
echo $list;
