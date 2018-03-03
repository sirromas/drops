<?php

require_once './classes/Report.php';
$r    = new Report();
$list = $r->get_revenue_report_page();
echo $list;