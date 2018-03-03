<?php

require_once './classes/Report.php';
$r      = new Report();
$userid = $_REQUEST['userid'];
$list   = $r->get_manager_revenue_report($userid);
echo $list;

