<?php

require_once './classes/Feedback.php';
$f = new Feedback();
$type = $_POST['type'];
$list = $f->get_suggest_dialog($type);
echo $list;
