<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/custom/utils/classes/Utils.php';

class Enroll extends Utils
{

    /**
     * Feedback constructor.
     */
    function __construct()
    {
        parent::__construct();
    }


    /**
     * @param $user
     * @return mixed
     */
    function enroll_user($user)
    {
        $pwd = 'strange12'; // pwd is same for all users from beginng
        $new_user = create_user_record($user->email, $pwd);
        $id = $new_user->id;
        if ($id > 0) {
            $user->id = $id;
            $query = "update mdl_user set "
                . "firstname='$user->fname', "
                . "lastname='$user->lname', "
                . "email='$user->email', phone1='$user->phone', address='$user->address' where id=$id";
            $this->db->query($query);
            $this->assign_roles($id, $user->courseid);
            $pstatus = $this->is_payment_exists($user->transactionid);
            if ($pstatus == 0) {
                $this->add_paypal_payment($user);
            }
        } // end if
        else {
            $id = -1;
        } // end else
        return $id;
    }

    /**
     * @param $userid
     * @param $courseid
     */
    function assign_roles($userid, $courseid)
    {
        $roleid = 5;
        $enrolid = $this->getEnrolId($courseid);
        $contextid = $this->getCourseContext($courseid, $roleid);
        $already_enrolled = $this->already_enrolled($courseid, $userid);
        if ($already_enrolled == 0) {

            // 1. Insert into mdl_user_enrolments table
            $query = "insert into mdl_user_enrolments
             (enrolid,
              userid,
              timestart,
              modifierid,
              timecreated,
              timemodified)
               values ('" . $enrolid . "',
                       '" . $userid . "',
                        '" . time() . "',   
                        '2',
                         '" . time() . "',
                         '" . time() . "')";
            //echo "Query: ".$query."<br/>";
            $this->db->query($query);

            // 2. Insert into mdl_role_assignments table
            $query = "insert into mdl_role_assignments
                  (roleid,
                   contextid,
                   userid,
                   timemodified,
                   modifierid)                   
                   values ('" . $roleid . "',
                           '" . $contextid . "',
                           '" . $userid . "',
                           '" . time() . "',
                            '2'         )";
            // echo "Query: ".$query."<br/>";
            $this->db->query($query);
        } // end if $already_endrolled==0
    }

    /**
     * @param $courseid
     * @return mixed
     */
    function getCourseContext($courseid)
    {
        $query = "select id from mdl_context
                     where contextlevel=50
                     and instanceid='" . $courseid . "' ";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $contextid = $row['id'];
        }
        return $contextid;
    }

    /**
     * @param $courseid
     * @return mixed
     */
    function getEnrolId($courseid)
    {
        $query = "select id from mdl_enrol
                     where courseid=" . $courseid . " and enrol='manual'";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $enrolid = $row['id'];
        }
        return $enrolid;
    }

    /**
     * @param $courseid
     * @param $userid
     * @return int
     */
    function already_enrolled($courseid, $userid)
    {
        $enrolid = $this->getEnrolId($courseid);
        $query = "select * from mdl_user_enrolments "
            . "where enrolid=$enrolid "
            . "and userid=$userid";
        $num = $this->db->numrows($query);
        return $num;
    }

    /**
     * @param $user
     */
    function add_paypal_payment($user)
    {
        $now = time();
        $query = "insert into mdl_paypal_payments 
                (courseid,
                 userid,
                 psum,
                 trans_id,
                 pdate) values ('$user->courseid',
                                '$user->id',
                                '$user->amount',
                                '$user->transactionid',
                                '$now')";
        $this->db->query($query);
    }

    /**
     * @param $transid
     * @return int
     */
    function is_payment_exists($transid)
    {
        $query = "select * from mdl_paypal_payments where trans_id='$transid'";
        $num = $this->db->numrows($query);
        return $num;
    }


}