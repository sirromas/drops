<?php

require_once './classes/News.php';
$n = new News();
$id = $_POST['id'];
$n->delete_news_item($id);
