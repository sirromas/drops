<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/custom/utils/classes/Utils.php';

class Users extends Utils
{

    const ROLE_ADMIN = 0;
    const ROLE_MANAGER = 1;
    const ROLE_TEACHER = 4;
    const ROLE_STUDENT = 5;
    const ROLE_COURSE_MANAGER = 9;
    const ROLE_PARTNER = 10;

    /**
     * Users constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $roleid
     * @return string
     */
    function get_users_list($roleid)
    {
        $list = "";
        $users = $this->get_users_by_role($roleid);
        $list .= $this->create_users_list($users);
        return $list;
    }

    /**
     * @param $users
     * @return string
     */
    function create_users_list($users)
    {
        $list = "";
        $list .= "<table id='users_table' class='display' cellspacing='0' width='100%'>";
        $list .= "<thead>";
        $list .= "<tr>";
        $list .= "<th>FirstName</th>";
        $list .= "<th>LastName</th>";
        $list .= "<th>Email</th>";
        $list .= "<th>Last Access</th>";
        $list .= "<th>Link</th>";
        $list .= "</tr>";
        $list .= "</thead>";
        $list .= "<tbody>";
        if (count($users) > 0) {
            foreach ($users as $userid) {
                $user = $this->get_user_details($userid);
                $fname = $user->firstname;
                $lname = $user->lastname;
                $email = $user->email;
                if ($user->lastaccess != 0) {
                    $laccess = date('m-d-Y', $user->lastaccess);
                } // end if
                else {
                    $laccess = 'N/A';
                }
                $url = "https://" . $_SERVER['SERVER_NAME'] . "/lms/user/profile.php?id=$userid";
                $link = "<a href='$url' target='_blank'>Profile Link</a>";
                $list .= "<tr>";
                $list .= "<td>$fname</td>";
                $list .= "<td>$lname</td>";
                $list .= "<td>$email</td>";
                $list .= "<td>$laccess</td>";
                $list .= "<td>$link</td>";
                $list .= "</tr>";
            } // end foreach
        } // end if count($users)>0
        $list .= "</tbody>";
        $list .= "</table>";
        return $list;
    }

}