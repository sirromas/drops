<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/custom/utils/classes/Utils.php';
require_once $_SERVER['DOCUMENT_ROOT']
    . '/lms/custom/enroll/classes/Enroll.php';
require_once $_SERVER['DOCUMENT_ROOT']
    . '/lms/custom/mailer/vendor/PHPMailerAutoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/lib/coursecatlib.php';

class Users extends Utils
{

    const ROLE_TEACHER = 4;
    const ROLE_STUDENT = 5;
    const ROLE_COURSE_MANAGER = 11;
    const ROLE_PARTNER = 12;

    public $mail_smtp_host = 'smtp.learningindrops.com';
    //public $mail_smtp_port = 25;
    public $mail_smtp_port = 587;
    public $mail_smtp_user = 'info@learningindrops.com';
    public $mail_smtp_pwd = 'aK6SKymc*';

    /**
     * Users constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $roleid
     *
     * @return string
     */
    function get_users_list($roleid)
    {
        $list   = "";
        $userid = $this->user->id;
        if ($userid == 2) {
            $users = $this->get_users_by_role($roleid);
        } // end if
        else {
            $catid   = $this->get_manager_category($userid);
            $courses = $this->get_category_courses($catid);
            $users   = $this->get_users_by_role($roleid, $courses);
        } // end else
        $list .= $this->create_users_list($users);

        return $list;
    }

    /**
     * @param $users
     *
     * @return string
     */
    function create_users_list($users)
    {
        /*
        echo "Users: <pre>";
        print_r($users);
        echo "</pre>";
        */

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
                $user  = $this->get_user_details($userid);
                $fname = $user->firstname;
                $lname = $user->lastname;
                $email = $user->email;
                if ($user->lastaccess != 0) {
                    $laccess = date('m-d-Y', $user->lastaccess);
                } // end if
                else {
                    $laccess = 'N/A';
                }
                $url  = "https://" . $_SERVER['SERVER_NAME']
                    . "/lms/user/profile.php?id=$userid";
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

    /**
     * @param $courseid
     *
     * @return mixed
     */
    function get_course_name($courseid)
    {
        $query  = "select * from mdl_course where id=$courseid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['fullname'];
        }

        return $name;
    }

    /**
     * @param $courses
     *
     * @return string
     */
    function manager_category_courses($courses)
    {
        $list = "";
        $list .= "<select id='courses' style='width: 220px;'>";
        $list .= "<option value='0' selected>Please select course</option>";
        foreach ($courses as $courseid) {
            $name = $this->get_course_name($courseid);
            $list .= "<option value='$courseid'>$name</option>";
        } // end foreach
        $list .= "</select>";

        return $list;
    }

    /**
     * @return string
     */
    function get_user_quota_dropbox()
    {
        $list = "";
        $list .= "<select id='quota' style='width: 220px;'>";
        $list .= "<option value='0' selected>Please select quota</option>";
        for ($i = 1; $i <= 10; $i++) {
            $name = $i . ' GB';
            $list .= "<option value='$i'>$name</option>";
        } // end for
        $list .= "</select>";

        return $list;
    }


    /**
     * @return string
     */
    function get_add_new_user_dialog()
    {
        $list     = "";
        $userid   = $this->user->id;
        $catid    = $this->get_manager_category($userid);
        $courses  = $this->get_category_courses($catid);
        $mcourses = $this->manager_category_courses($courses);
        $quota    = $this->get_user_quota_dropbox();

        $list
            .= "<div class='panel panel-default'>
                    
                    <div class='modal-footer'><div class='title'>Add New User</div></div>
                    <div class='panel-body'> 
                    <input type='hidden' id='userid' value='$userid'>
                    
                    <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                    <span class='col-md-3'>Type*</span>
                    <span class='col-md-6'><input type='radio' class='roleid' value='5' checked name='roleid'>Student 
                    &nbsp;&nbsp;<input type='radio' class='roleid' value='4' name='roleid'>Teacher</span>
                    </div>
                
                    <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                    <span class='col-md-3'>Firstname*</span>
                    <span class='col-md-6'><input type='text' id='fname'></span>
                    </div>
                    
                    <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                    <span class='col-md-3'>Lastname*</span>
                    <span class='col-md-6'><input type='text' id='lname'></span>
                    </div>
                    
                    <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                    <span class='col-md-3'>Email*</span>
                    <span class='col-md-6'><input type='text' id='email'></span>
                    </div>
                    
                    <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                    <span class='col-md-3'>Course*</span>
                    <span class='col-md-6'>$mcourses</span>
                    </div>
                    
                    <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                    <span class='col-md-3'>Quota</span>
                    <span class='col-md-6'>$quota</span>
                    </div>
                    
                    <div class='row'>
                    <span class='col-md-3'></span>
                    <span class='col-md-6' id='user_err' style='color: red;width: 885px;margin-left: 15px;'></span>
                    </div>
                  
                    <div class='modal-footer'>
                    <button type='button' class='btn btn-primary' id='manager_add_user'>Submit</button>
                    </div>
                    
                    <div class='row' style='text-align: center;display: none;' id='ajax_loader'>
                    <span class='col-md-9' style='text-align: center;'><img src='https://learningindrops.com/assets/img/ajax_loader.gif'></span>
                    </div>
                   
                    </div>
                </div>";

        return $list;

    }


    /**
     * @param $item
     */
    function add_new_user_done($item)
    {
        $list         = "";
        $en           = new Enroll();
        $pw           = $en->generateRandomString(8);
        $pwd          = password_hash($pw, PASSWORD_DEFAULT);
        $userid       = $en->create_user($item, $pwd);
        $item->userid = $userid;
        $item->pwd    = $pw;
        $this->update_user_data($item);
        $en->assign_roles($item->userid, $item->courseid, $item->roleid);

        $list .= "<div class='row'>";
        $list .= "<span class='col-md-6'>New user was successfully created</span>";
        $list .= "</div>";

        $list .= "<div class='row'>";
        $list .= "<span class='col-md-2'>Username:</span>";
        $list .= "<span class='col-md-6'>$item->email</span>";
        $list .= "</div>";

        $list .= "<div class='row'>";
        $list .= "<span class='col-md-2'>Password:</span>";
        $list .= "<span class='col-md-6'>$item->pwd</span>";
        $list .= "</div><br>";
        $this->send_confirmation_email($item);

        return $list;

    }

    function send_confirmation_email($item)
    {
        $list = "";

        $img_path = 'https://' . $_SERVER['SERVER_NAME']
            . '/assets/img/logo.png';
        $img      = "<img src='$img_path'>";
        $username = $item->email;
        $password = $item->pwd;

        $list .= "<html>";
        $list .= "<body>";

        $list .= "<br>";
        $list .= "<table>";

        $list .= "<tr>";
        $list .= "<td style='text-align: center; padding: 15px;' colspan='2'>$img</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='text-align: center; padding: 15px;' colspan='2'>Dear User!</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='text-align: center; padding: 15px;' colspan='2'>Your Learning Drops account has been created!</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='padding: 15px;'>Username</td>";
        $list .= "<td style='padding: 15px;'>$username</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='padding: 15px;'>Password</td>";
        $list .= "<td style='padding: 15px;'>$password</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='text-align: center; padding: 15px;' colspan='2'>Click <a href='https://learningindrops.com/index.php/navigation/login' target='_blank'>here</a> to login into system</td>";
        $list .= "</tr>";

        $list .= "</table>";
        $list .= "</body>";
        $list .= "</html>";

        $mail = new PHPMailer();

        $addressA = 'sirromas@gmail.com';
        $addressB = 'helainefpsantos@gmail.com';

        //$mail->isSMTP();
        $mail->Host       = $this->mail_smtp_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $this->mail_smtp_user;
        $mail->Password   = $this->mail_smtp_pwd;
        $mail->SMTPSecure = 'tls';
        //$mail->SMTPSecure = false;
        $mail->Port      = $this->mail_smtp_port;
        $mail->SMTPDebug = 4;
        $mail->setFrom($this->mail_smtp_user, 'Learning Drops');

        $mail->addAddress($username);
        $mail->addCC($addressA);
        $mail->addCC($addressB);

        $mail->addReplyTo($this->mail_smtp_user, 'Learning Drops');
        $mail->isHTML(true);
        $mail->Subject = 'Learning Drops - Account Created';
        $mail->Body    = $list;
        if ( ! $mail->send()) {
            echo "Mailer error: $mail->ErrorInfo";

            return false;
        } // end if !$mail->send()
        else {
            echo "Confirmation Email has been sent to $username";

            return true;
        }
    }

    /**
     * @param $item
     */
    function update_user_data($item)
    {
        $query
            = "update mdl_user 
                set firstname='$item->fname', 
                lastname='$item->lname', 
                email='$item->email', 
                quota='$item->quota' 
                where id=$item->userid";
        $this->db->query($query);
    }

    function get_add_manager_dialog()
    {
        $list = "";

        $list
            .= "<div class='panel panel-default'>
                    
                    <div class='modal-footer'><div class='title'>Add New Manager</div></div>
                    <div class='panel-body'> 
                 
                    <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                    <span class='col-md-3'>Firstname*</span>
                    <span class='col-md-6'><input type='text' id='fname'></span>
                    </div>
                    
                    <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                    <span class='col-md-3'>Lastname*</span>
                    <span class='col-md-6'><input type='text' id='lname'></span>
                    </div>
                    
                    <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                    <span class='col-md-3'>Email*</span>
                    <span class='col-md-6'><input type='text' id='email'></span>
                    </div>
                    
                    <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                    <span class='col-md-3'>Manager Category*</span>
                    <span class='col-md-6'><input type='text' id='category'></span>
                    </div>
                    
                    <div class='row'>
                    <span class='col-md-3'></span>
                    <span class='col-md-6' id='manager_err' style='color: red;width: 885px;margin-left: 15px;'></span>
                    </div>
                  
                    <div class='modal-footer'>
                    <button type='button' class='btn btn-primary' id='add_manager_done'>Submit</button>
                    </div>
                    
                    <div class='row' style='text-align: center;display: none;' id='ajax_loader'>
                    <span class='col-md-9' style='text-align: center;'><img src='https://learningindrops.com/assets/img/ajax_loader.gif'></span>
                    </div>
                   
                    </div>
                </div>";

        return $list;
    }

    function add_new_manager($item)
    {
        $list         = "";
        $en           = new Enroll();
        $purepwd      = $en->generateRandomString(8);
        $pwd          = password_hash($purepwd, PASSWORD_DEFAULT);
        $userid       = $en->create_user($item, $pwd);
        $item->userid = $userid;
        $item->pwd    = $purepwd;
        $item->quota  = 3;
        $this->update_user_data($item);

        $data              = new stdClass();
        $data->name        = $item->cat;
        $data->description = $item->cat;
        $data->idnumber    = '';
        $category          = coursecat::create($data);

        if ($userid > 0 && $category->id > 0) {

            $query
                = "insert into mdl_cat_manager (catid, userid) 
                  values ($category->id, $userid)";
            $this->db->query($query);
            $username = $item->email;

            $list .= "<div class='row'>";
            $list .= "<span class='col-md-6'>New manager was successfully created</span>";
            $list .= "</div>";

            $list .= "<div class='row'>";
            $list .= "<span class='col-md-3'>Username:</span>";
            $list .= "<span class='col-md-3'>$username</span>";
            $list .= "</div>";

            $list .= "<div class='row'>";
            $list .= "<span class='col-md-3'>Password</span>";
            $list .= "<span class='col-md-3'>$purepwd</span>";
            $list .= "</div>";
            $this->assign_manager_role($item);
            $this->send_confirmation_email($item);

        } // end if
        else {
            $list .= "<div class='row' style='text-align: center;'>";
            $list .= "<span class='col-md-6'>New manager was was not created due to error</span>";
            $list .= "</div>";
        } // end else


        return $list;

    }

    function assign_manager_role($item)
    {
        $roleid    = 11;
        $contextid = 1;
        $now       = time();
        $query
                   = "insert into mdl_role_assignments 
                (roleid,
                contextid,
                userid,
                timemodified,
                modifierid) 
                values ($roleid,
                        $contextid,
                        $item->userid,'$now',2)";
        $this->db->query($query);
    }


}