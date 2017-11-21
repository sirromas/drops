<?php

require_once './classes/Slider.php';
$sl = new Slider();
$file = $_FILES[0];
$post = $_POST;
$sl->upload_slide($file, $post);

