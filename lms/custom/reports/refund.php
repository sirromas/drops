<?php

require_once './classes/Report.php';
$r       = new Report();
$transid = $_REQUEST['transid'];
$r->refund($transid);
