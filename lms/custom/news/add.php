<?php

require_once './classes/News.php';
$n = new News();
$item = $_POST['item'];
$n->add_news(json_decode($item));
