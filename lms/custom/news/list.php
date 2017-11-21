<?php

require_once './classes/News.php';
$n = new News();
$list = $n->get_news_list();
echo $list;

?>

