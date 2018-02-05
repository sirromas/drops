<?php

require_once './classes/Search.php';
$s    = new Search();
$item = $_POST['item'];
$list = $s->searchItem( $item );
echo $list;