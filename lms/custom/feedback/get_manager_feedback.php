<?php

require_once './classes/Feedback.php';
$f    = new Feedback();
$type = $_REQUEST['type'];
$list = $f->get_manager_feedback($type);
echo $list;