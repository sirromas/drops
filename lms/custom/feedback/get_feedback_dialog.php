<?php

require_once './classes/Feedback.php';
$f = new Feedback();
$list = $f->get_feedback_dialog();
echo $list;