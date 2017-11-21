<?php

require_once './classes/Slider.php';
$sl = new Slider();
$list = $sl->get_sliders_list();
echo $list;



