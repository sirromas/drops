<?php

require_once './classes/Feedback.php';
$f = new Feedback();
$item = $_POST['item'];
$f->add_student_suggest(json_decode($item));
