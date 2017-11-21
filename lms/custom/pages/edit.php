<?php

require_once './classes/Page.php';
$p = new Page();
$id = $_POST['id'];
$list = $p->get_page_content($id);
echo $list;

