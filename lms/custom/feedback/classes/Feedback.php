<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/custom/utils/classes/Utils.php';

class Feedback extends Utils
{

    /**
     * Feedback constructor.
     */
    function __construct()
    {
        parent::__construct();
    }


    /**
     * @return string
     */
    function get_feedback_page()
    {
        $list = "";

        $list .= "<table id='feedback_table' class='display' cellspacing='0' width='100%'>";
        $list .= "<thead>";
        $list .= "<tr>";
        $list .= "<th>Name</th>";
        $list .= "<th>Email</th>";
        $list .= "<th>Phone</th>";
        $list .= "<th>Message</th>";
        $list .= "<th>Date</th>";
        $list .= "</tr>";
        $list .= "</thead>";
        $list .= "<tbody>";
        $query = "select * from mdl_contact_requests order by added desc";
        $num = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $name = $row['name'];
                $email = $row['email'];
                $phone = $row['phone'];
                $msg = $row['msg'];
                $date = date('m-d-Y', $row['added']);
                $list .= "<tr>";
                $list .= "<td>$name</td>";
                $list .= "<td>$email</td>";
                $list .= "<td>$phone</td>";
                $list .= "<td>$msg</td>";
                $list .= "<td>$date</td>";
                $list .= "</tr>";
            } // end while
        } // end if $num>0
        $list .= "</tbody>";
        $list .= "</table>";
        return $list;
    }


}