<?php

require_once './classes/News.php';
$n = new News();
$post = $_POST;
$file = $_FILES;
$n->update_news_item($file, $post);
