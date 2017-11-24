<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/utils/classes/Utils.php';

class Report extends Utils
{

    function __construct()
    {
        parent::__construct();
    }


    /**
     * @return string
     */
    function get_revenue_report_page()
    {
        $list = "";

        $list .= "<table id='reports_table' class='display' cellspacing='0' width='100%'>";

        $list .= "<thead>";
        $list .= "<tr>";
        $list .= "<th>User Name</th>";
        $list .= "<th>Course Applied</th>";
        $list .= "<th>Amount Paid</th>";
        $list .= "<th>Transaction</th>";
        $list .= "<th>Date</th>";
        $list .= "</tr>";
        $list .= "</thead>";

        $list .= "<tbody>";
        $query = "select * from mdl_paypal_payments order by pdate";
        $num = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $userid = $row['userid'];
                $courseid = $row['courseid'];
                $coursename = $this->get_course_name($courseid);
                $date = date('m-d-Y h:i:s', $row['pdate']);
                $userdata = $this->get_user_details($userid);
                $fname = $userdata->firstname;
                $lname = $userdata->lastname;
                $amount = $row['psum'].' BRL';
                $transaction = $row['trans_id'];
                $link = "http://" . $_SERVER['SERVER_NAME'] . "/clientes/drops/lms/user/profile.php?id=$userid";
                $profile = "<a href='$link' target='_blank'>$fname $lname</a>";
                $list .= "<tr>";
                $list .= "<td>$profile</td>";
                $list .= "<td>$coursename</td>";
                $list .= "<td>$amount</td>";
                $list .= "<td>$transaction</td>";
                $list .= "<td>$date</td>";
                $list .= "</tr>";
            } // end while
        } // end if $num > 0
        $list .= "</tbody>";
        $list .= "</table>";

        return $list;
    }

    /**
     * @param $courseid
     * @return mixed
     */
    function get_course_name($courseid)
    {
        $query = "select * from mdl_course where id=$courseid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['fullname'];
        }
        return $name;
    }

}