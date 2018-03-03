<?php

require_once './classes/Enroll.php';
require_once '../utils/classes/Utils.php';
$en     = new Enroll();
$ut     = new Utils();
$userid = 5;

echo "User ID: " . $userid . "<br><br>";

$catid   = $ut->get_manager_category($userid);
$courses = $ut->get_category_courses($catid);
if (count($courses) > 0) {
    foreach ($courses as $courseid) {
        echo "CourseID: " . $courseid . "<br>";
        $status = $en->is_manager_already_enrolled($courseid, $userid);
        echo "Enrollment status: " . $status . "<br>";
        if ($status == 0) {
            $en->assign_roles($userid, $courseid, $en::MANAGER_ROLE);
            echo "Enrolled .... <br>";
        } // end if status
    } // end foreach
} // end if count($courses) > 0

