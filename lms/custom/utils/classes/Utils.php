<?php

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
        $this->homeurl='http://theberry.us/clientes/drops';
    }

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


}