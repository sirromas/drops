<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/lms/custom/utils/classes/Utils.php');
require_once($_SERVER['DOCUMENT_ROOT']
    . '/lms/custom/mailchimp/classes/Mailchimp.php');


class Promotion extends Utils
{
    /**
     * @var Maim
     */
    public $mailchimp;

    /**
     * Promotion constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->mailchimp = new Maim();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function get_courseid_by_context($id)
    {
        $query  = "select * from mdl_context where id=$id";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $courseid = $row['instanceid'];
        }

        return $courseid;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function get_user_rolename($id)
    {
        $query  = "select * from mdl_role where id=$id";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['shortname'];
        }

        return $name;
    }

    /**
     * @param $id
     *
     * @return string
     */
    function get_course_name($id)
    {
        $query  = "select * from mdl_course where id=$id";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['fullname'];
        }

        if (isset($name)) {
            return $name;
        } // end if
        else {
            return 'N/A';
        }
    }

    /**
     * @return string
     */
    function get_users_table()
    {
        $list = "";
        $list .= "<div class='row' style='margin-bottom:25px;'>";
        $list .= "<table id='promotion_table' class='display' cellspacing='0' width='100%'>";
        $list .= "<thead>";
        $list .= "<th><input type='checkbox' id='check_all'>&nbsp;User</th>";
        $list .= "<th>Program</th>";
        $list .= "<th>Role</th>";
        $list .= "</thead>";

        $list .= "<tbody>";

        $query = "select * from mdl_role_assignments";
        $num   = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $user      = $this->get_user_details($row['userid']);
                $firstname = $user->firstname;
                $lastname  = $user->lastname;
                $email     = $user->email;

                $name = "<span style='margin-left:9px;'><input type='checkbox' class='user' data-userid='"
                    . $row['userid']
                    . "' data-email='$email' value='$email'></span>&nbsp;"
                    . utf8_encode($firstname) . ' '
                    . utf8_encode($lastname) . '<br>' . '<span style="margin-left: 23px;">'
                    . $email . '</span>';
                $courseid   = $this->get_courseid_by_context($row['contextid']);
                $coursename = utf8_encode($this->get_course_name($courseid));
                $rolename   = $this->get_user_rolename($row['roleid']);

                $list .= "<tr>";
                $list .= "<td>$name</td>";
                $list .= "<td>$coursename</td>";
                $list .= "<td>$rolename</td>";
                $list .= "</tr>";

            } // end while
        } // end if $num>0

        $list .= "</tbody>";

        $list .= "</table>";
        $list .= "</div>";

        $list .= "<div class='row' style='margin-left: 0px;'>";
        $list .= "<span class='col-md-5' ><button class='btn btn-primary' id='show_message_editor' disabled>Message Content</button></span>";
        $list .= "</div>";

        $list .= "<div class='row' id='msg_div' style='display: none; margin-top: 25px;'>";

        $list .= "<div class='row'>";
        $list .= "<span class='col-md-12'><input type='text' id='msg_subject' style='width: 100%;' placeholder='Subject*'></span>";
        $list .= "</div>";

        $list .= "<div class='row'>";
        $list .= "<span class='col-md-12'><div id='msg_editor'></div></span>";
        $list
              .= "<script>
                CKEDITOR.replace( 'msg_editor');
                </script>";
        $list .= "</div>";

        $list .= "<div class='row' style='text-align: center;margin-top: 15px;'>";
        $list .= "<span class='col-md-12' id='ajax_loader' style='display: none;'><img src='/assets/img/ajax_loader.gif'></span>";
        $list .= "</div>";

        $list .= "<div class='row'>";
        $list .= "<span class='col-md-12' id='campaign_err' style='color:red;'></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='margin-left: 0px;margin-top: 15px;'>";
        $list .= "<span class='col-md-6'><button class='btn btn-primary' id='add_mailchimp_campaign'>Add New Campaign</button></span>";
        $list .= "</div>";

        $list .= "</div>";

        return $list;
    }


    /**
     * @return string
     */
    function get_promotion_page()
    {
        $list = "";

        $list .= $this->get_users_table();

        return $list;
    }

    function add_new_campaign($item)
    {
        $users = explode(',', $item->users);
        $this->mailchimp->prepare_campaign($item->subject, $item->msg, $users);
        $list = "<p style='color:black;'>New Mailchimp campaign was scheduled and will be sent soon.</p>";

        return $list;
    }


}