<?php
require_once './classes/News.php';
$n = new News();
$list = $n->get_add_news_modal_dialog();
echo $list;

