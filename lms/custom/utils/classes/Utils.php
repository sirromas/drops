<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/class.pdo.database.php';


class Utils
{

    /**
     * Utils constructor.
     */

    public $homeurl;

    function __construct()
    {
        global $CFG, $DB, $USER, $COURSE, $SESSION;
        $db             = new pdo_db();
        $this->cfg      = $CFG;
        $this->db       = $db;
        $this->moodledb = $DB;
        $this->user     = $USER;
        $this->course   = $COURSE;
        $this->session  = $SESSION;
        $this->homeurl  = 'https://learningindrops.com';
    }

    /**
     * @param $userid
     *
     * @return int
     */
    function get_user_role($userid, $contextid = 0)
    {
        if ($userid == 2) {
            // It is admin
            $roleid = 0;
        } // end if
        else {
            if ($contextid == 0) {
                $query
                    = "select * from  mdl_role_assignments 
                          where userid=$userid";
            } // end if
            else {
                $query
                    = "select * from  mdl_role_assignments 
                          where contextid=$contextid and userid=$userid";
            }
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $roleid = $row['roleid'];
            }
        }

        return $roleid;
    }


    /**
     * @param $courseid
     *
     * @return mixed
     */
    function get_course_context($courseid)
    {
        $query
                = "select * from mdl_context WHERE contextlevel=50 and instanceid=$courseid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $contextid = $row['id'];
        }

        return $contextid;
    }

    /**
     * @param $roleid
     *
     * @return array
     */
    function get_users_by_role($roleid, $courses = array())
    {
        $users  = array();
        $userid = $this->user->id;
        //echo "User ID: ".$userid."<br>";
        //echo "Role ID for search: ".$roleid."<br>";
        if ($userid == 2) {
            $query
                = "select * from mdl_role_assignments 
                            where roleid=$roleid group by userid";
            $num = $this->db->numrows($query);
            if ($num > 0) {
                $result = $this->db->query($query);
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $id         = $row['userid'];
                    $del_status = $this->is_user_deleted($id);
                    $sus_status = $this->is_user_suspended($id);
                    if ($del_status == 0 && $sus_status == 0) {
                        $users[] = $id;
                    } // end if
                } // end while
            } // end if $num > 0
            return $users;
        } // end if $userid == 2
        else {
            if (count($courses) > 0) {
                foreach ($courses as $courseid) {
                    $contexts[] = $this->get_course_context($courseid);
                }
                $cs  = implode(',', $contexts);
                $query
                     = "select * from mdl_role_assignments 
                            where contextid in ($cs) 
                            and roleid=$roleid group by userid";
                $num = $this->db->numrows($query);
                if ($num > 0) {
                    $result = $this->db->query($query);
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $id         = $row['userid'];
                        $del_status = $this->is_user_deleted($id);
                        $sus_status = $this->is_user_suspended($id);
                        if ($del_status == 0 && $sus_status == 0) {
                            $users[] = $id;
                        } // end if
                    } // end while
                } // end if
            } // end if count($courses)>0
        } // end else

        return $users;
    }

    /**
     * @param $userid
     *
     * @return mixed
     */
    function is_user_deleted($userid)
    {
        $query  = "select * from mdl_user where id=$userid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $status = $row['deleted'];
        }

        return $status;
    }

    /**
     * @param $userid
     *
     * @return mixed
     */
    function is_user_suspended($userid)
    {
        $query  = "select * from mdl_user where id=$userid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $status = $row['suspended'];
        }

        return $status;
    }

    /**
     * @param $userid
     *
     * @return stdClass
     */
    function get_user_details($userid)
    {
        if ($userid > 0) {
            $query  = "select * from mdl_user where id=$userid";
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $user = new stdClass();
                foreach ($row as $key => $value) {
                    $user->$key = $value;
                }
            }
        } // end if $userid>0
        else {
            $user             = new stdClass();
            $user->firstname  = 'Friend';
            $user->lastname   = 'User';
            $user->email      = 'N/A';
            $user->lastaccess = '0';
        } // end else

        return $user;
    }

    /**
     * @param $userid
     *
     * @return mixed
     */
    function get_manager_category($userid)
    {
        $query  = "select * from mdl_cat_manager where userid=$userid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $catid = $row['catid'];
        }

        return $catid;
    }

    /**
     * @param $courseid
     */
    function get_course_users($courseid)
    {
        $users   = array();
        $enrolid = $this->getEnrolId($courseid);
        $query   = "select * from mdl_user_enrolments where enrolid=$enrolid";
        $num     = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $users[] = $row['userid'];
            }
        } // end if $num>0

        return $users;
    }

    /**
     * @param $courseid
     *
     * @return mixed
     */
    function getEnrolId($courseid)
    {
        $query
                = "select id from mdl_enrol
                     where courseid=" . $courseid . " and enrol='manual'";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $enrolid = $row['id'];
        }

        return $enrolid;
    }

    /**
     * @param $catid
     *
     * @return array
     */
    function get_category_users($catid)
    {
        $users   = array();
        $courses = $this->get_category_courses($catid);
        if (count($courses) > 0) {
            foreach ($courses as $courseid) {
                $cusers = $this->get_course_users($courseid);
                if (count($cusers) > 0) {
                    foreach ($cusers as $userid) {
                        $users[] = $userid;
                    } // end foreach
                } // end if count($cusers)>0
            } // end foreach
        } // end if count($courses)>0

        return $users;
    }

    /**
     * @param $catid
     *
     * @return array
     */
    function get_category_courses($catid)
    {
        $courses = array();
        $query   = "select * from mdl_course where category=$catid";
        $num     = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $courses[] = $row['id'];
            }
        }

        return $courses;
    }

}