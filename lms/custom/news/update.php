<?php

require_once './classes/News.php';
$n = new News();
$item = $_POST['item'];
$n->update_news_item(json_decode($item));
