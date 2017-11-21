<?php

require_once './classes/Slider.php';
$sl = new Slider();
$id = $_POST['id'];
$list = $sl->get_slide_upload_dialog($id);
echo $list;
