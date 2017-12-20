<?php

require_once './classes/News.php';
$n = new News();
$post = $_POST;
$file = $_FILES;
$n->add_news($file, $post);


