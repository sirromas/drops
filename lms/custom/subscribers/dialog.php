<?php

require_once './classes/Subscribers.php';
$s = new Subscribers();
$id = $_POST['id'];
$list = $s->get_subs_dialog($id);
echo $list;