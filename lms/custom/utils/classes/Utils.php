<?php

//require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/config.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/class.pdo.database.php';


require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/class.pdo.database.php';


class Utils
{

    /**
     * Utils constructor.
     */

    public $homeurl;

    function __construct()
    {
        global $USER, $COURSE, $SESSION;
        $db = new pdo_db();
        $this->db = $db;
        $this->user = $USER;
        $this->course = $COURSE;
        $this->session = $SESSION;
        // $this->homeurl = 'https://learningindrops.com';
	    $this->homeurl = 'http://theberry.us/clientes/drops/';
    }

    /**
     * @param $userid
     * @return int
     */
    function get_user_role($userid)
    {
        if ($userid == 2) {
            // It is admin
            $roleid = 0;
        } // end if
        else {
            $query = "select * from  mdl_role_assignments where userid=$userid";
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $roleid = $row['roleid'];
            }
        }
        return $roleid;
    }

    /**
     * @param $userid
     * @return mixed
     */
    function is_user_deleted($userid)
    {
        $query = "select * from mdl_user where id=$userid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $status = $row['deleted'];
        }
        return $status;
    }


    /**
     * @param $userid
     * @return mixed
     */
    function is_user_suspended($userid)
    {
        $query = "select * from mdl_user where id=$userid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $status = $row['suspended'];
        }
        return $status;
    }

    /**
     * @param $roleid
     * @return array
     */
    function get_users_by_role($roleid)
    {
        $users = array();
        $query = "select * from mdl_role_assignments where roleid=$roleid group by userid";
        $num = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['userid'];
                $del_status = $this->is_user_deleted($id);
                $sus_status = $this->is_user_suspended($id);
                if ($del_status == 0 && $sus_status == 0) {
                    $users[] = $id;
                }
            }
        }
        return $users;
    }

    /**
     * @param $userid
     * @return stdClass
     */
    function get_user_details($userid)
    {
        $query = "select * from mdl_user where id=$userid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $user = new stdClass();
            foreach ($row as $key => $value) {
                $user->$key = $value;
            }
        }
        return $user;
    }


}