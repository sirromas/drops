<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/custom/utils/classes/Utils.php';

class Report extends Utils
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $courseid
     *
     * @return mixed
     */
    function get_course_category($courseid)
    {
        $catname='';
        if ($courseid>0) {
            $query  = "select * from mdl_course where id=$courseid";
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $catid = $row['category'];
            }

            if (isset($catid) && $catid>0) {
                $query  = "select * from mdl_course_categories where id=$catid";
                $result = $this->db->query($query);
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $catname = $row['name'];
                }
            }
        }

        return $catname;
    }


    /**
     * @return string
     */
    function get_revenue_report_page()
    {
        $list = "";
        $userid=$this->user->id;
        $list .= "<input type='hidden' id='userid' value='$userid'>";
        $list .= "<table id='reports_table' class='display' cellspacing='0' width='100%'>";

        $list .= "<thead>";
        $list .= "<tr>";
        $list .= "<th>Usuário</th>";
        $list .= "<th>Curso</th>";
        $list .= "<th>Valor Pago</th>";
        $list .= "<th>ID da Transação</th>";
        $list .= "<th>Data</th>";
        $list .= "<th>Ops</th>";
        $list .= "</tr>";
        $list .= "</thead>";

        $list .= "<tbody>";
        $query = "select * from mdl_paypal_payments where refunded=0 order by pdate desc";
        $num  = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $userid      = $row['userid'];
                $courseid    = $row['courseid'];
                $catname     = $this->get_course_category($row['courseid']);
                $coursename  = $this->get_course_name($courseid);
                $date        = date('m-d-Y h:i:s', $row['pdate']);
                $userdata    = $this->get_user_details($userid);
                $fname       = $userdata->firstname;
                $lname       = $userdata->lastname;
                $amount      = $row['psum'] . ' BRL';
                $transaction = $row['trans_id'];
                $link        = "https://" . $_SERVER['SERVER_NAME']
                    . "/lms/user/profile.php?id=$userid";
                $profile
                             = "<a href='$link' target='_blank'>$fname $lname</a>";
                $refund_btn  = $this->get_refund_button($row['trans_id']);

                if ($catname!='' && $coursename!='') {
                    $list .= "<tr>";
                    $list .= "<td>$profile</td>";
                    $list .= "<td><span style='font-weight: bold'>$catname</span><br>$coursename</td>";
                    $list .= "<td>$amount</td>";
                    $list .= "<td>$transaction</td>";
                    $list .= "<td>$date</td>";
                    $list .= "<td>$refund_btn</td>";
                    $list .= "</tr>";
                }
            } // end while
        } // end if $num > 0
        $list .= "</tbody>";
        $list .= "</table>";

        return $list;
    }

    /**
     * @param $courseid
     *
     * @return mixed
     */
    function get_course_name($courseid)
    {
        $name='';
        if ($courseid>0) {
            $query  = "select * from mdl_course where id=$courseid";
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $name = $row['fullname'];
            }
        }

        return $name;
    }

    /**
     * @param $userid
     *
     * @return string
     */
    function get_manager_revenue_report($userid)
    {
        $list    = "";
        $items   = array();
        $catid   = $this->get_manager_category($userid);
        $courses = $this->get_category_courses($catid);
        if (count($courses) > 0) {
            $cs  = implode(',', $courses);
            $query
                 = "select * from  mdl_paypal_payments 
                             where courseid in ($cs) and refunded=0 order by pdate desc";
            $num = $this->db->numrows($query);
            if ($num > 0) {
                $result = $this->db->query($query);
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $item = new stdClass();
                    foreach ($row as $key => $value) {
                        $item->$key = $value;
                    } // end foreach
                    $items[] = $item;
                } // end while
            } // end if $num > 0
        } // end if count($courses)>0
        $list .= $this->create_manager_revenue_report($items);

        return $list;
    }

    /**
     * @param $items
     *
     * @return string
     */
    function create_manager_revenue_report($items)
    {
        $list = "";
        $userid=$this->user->id;
        $list .="<input type='hidden' id='userid' value='$userid'>";

        $list .= "<table id='manager_revenue_table' class='display' cellspacing='0' width='100%'>";

        $list .= "<thead>";
        $list .= "<tr>";
        $list .= "<th>Usuário</th>";
        $list .= "<th>Curso</th>";
        $list .= "<th>Valor Pago</th>";
        $list .= "<th>ID da Transação</th>";
        $list .= "<th>Data</th>";
        $list .= "<th>Ops</th>";
        $list .= "</tr>";
        $list .= "</thead>";

        if (count($items) > 0) {
            $list .= "<tbody>";
            foreach ($items as $item) {
                $userid      = $item->userid;
                $courseid    = $item->courseid;
                $coursename  = $this->get_course_name($courseid);
                $date        = date('m-d-Y h:i:s', $item->pdate);
                $userdata    = $this->get_user_details($userid);
                $fname       = $userdata->firstname;
                $lname       = $userdata->lastname;
                $amount      = $item->psum . ' BRL';
                $transaction = $item->trans_id;
                $link        = "https://" . $_SERVER['SERVER_NAME']
                    . "/lms/user/profile.php?id=$userid";
                $profile
                             = "<a href='$link' target='_blank'>$fname $lname</a>";
                $ops         = $this->get_refund_button($transaction);
                $list        .= "<tr>";
                $list        .= "<td>$profile</td>";
                $list        .= "<td>$coursename</td>";
                $list        .= "<td>$amount</td>";
                $list        .= "<td>$transaction</td>";
                $list        .= "<td>$date</td>";
                $list        .= "<td>$ops</td>";
                $list        .= "</tr>";
            } // end foreach
        } // end if count($items)>0
        $list .= "</tbody>";

        $list .= "</table>";

        return $list;
    }

    /**
     * @param $transaction
     *
     * @return string
     */
    function get_refund_button($transaction)
    {
        $list = "";
        $list .= "<div class='row'>";
        $list .= "<span class='col-md-12'><button class='btn btn-primary' id='refund_$transaction'>Refund</button></span>";
        $list .= "</div>";

        return $list;
    }

    /**
     * @param $transid
     */
    function refund($transid)
    {
        $now    = time();
        $userid = $this->user->id;
        $query
                = "update mdl_paypal_payments set refunded=1, 
                       refund_date='$now', 
                       refunded_by=$userid 
                       where trans_id='$transid'";
        $this->db->query($query);
    }

}