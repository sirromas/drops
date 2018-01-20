<?php

require_once './classes/Feedback.php';
$f = new Feedback();
$post = $_POST;
$file = $_FILES;
$f->upload_resume($post, $file);