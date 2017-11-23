<?php

require_once './classes/Subscribers.php';
$s = new Subscribers();
$item = $_POST['item'];
$s->update_subs(json_decode($item));