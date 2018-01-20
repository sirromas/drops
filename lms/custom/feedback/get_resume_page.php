<?php

require_once './classes/Feedback.php';
$f = new Feedback();
$list = $f->get_student_feedback_page();
echo $list;