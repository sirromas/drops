<?php

require_once './classes/Courses.php';
$c               = new Courses();
$item            = new stdClass();
$item->userid    = 2;
$item->category  = 3; // possible to have 3
$item->fullname  = 'My Special Course4';
$item->shortname = 'MSP';

$c->add_new_course($item);





