<?php

require_once './classes/Page.php';
$p = new Page();
$item = $_POST['item'];
$list = $p->update_site_page(json_decode($item));
echo $list;