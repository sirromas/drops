<?php


//require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/class.pdo.database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/class.pdo.database.php';


class Enroll
{


    public $db;

    function __construct()
    {
        $this->db = new pdo_db();
    }


    /**
     * @param $user
     * @param $pwd
     * @return mixed
     */
    function create_user($user, $pwd)
    {
        $query = "insert into mdl_user (confirmed, mnethostid, username, password) values (1, 1, '$user->email', '$pwd')";
        $this->db->query($query);
        $stmt = $this->db->query("SELECT LAST_INSERT_ID()");
        $lastid_arr = $stmt->fetch(PDO::FETCH_NUM);
        $lastId = $lastid_arr[0];
        return $lastId;
    }

    /**
     * @param $user
     * @return int
     */
    function is_user_exists($user)
    {
        $query = "select * from mdl_user where username='$user->email'";
        $num = $this->db->numrows($query);
        return $num;
    }

    /**
     * @param int $length
     * @return string
     */
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * @param $user
     * @return mixed
     */
    function enroll_user($user)
    {
        $pwd = password_hash($user->pwd, PASSWORD_DEFAULT);
        $status = $this->is_user_exists($user);
        if ($status == 0) {
            $id = $this->create_user($user, $pwd);
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
        } // end if $status==0
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
        //echo "Already enrolled: ".$already_enrolled."<br>";
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
            //echo "Query: " . $query . "<br/>";
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
            // echo "Query: " . $query . "<br/>";
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
        $contextid = $this->getCourseContext($courseid);
        $query = "select * from mdl_role_assignments 
                    where contextid=$contextid and 
                          roleid=5 and 
                          userid=$userid";
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