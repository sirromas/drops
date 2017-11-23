<?php

require_once './classes/Users.php';
$u = new Users();
$roleid = $_POST['roleid'];
$list = $u->get_users_list($roleid);
echo $list;