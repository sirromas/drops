<?php

//require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/custom/utils/classes/Utils.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/custom/mailer/vendor/PHPMailerAutoload.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/utils/classes/Utils.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/mailer/vendor/PHPMailerAutoload.php';


class Feedback extends Utils
{

    public $mail_smtp_host = 'smtp.learningindrops.com';
    public $mail_smtp_port = 25;
    public $mail_smtp_user = 'info@learningindrops.com';
    public $mail_smtp_pwd = 'aK6SKymc*';

    /**
     * Feedback constructor.
     */
    function __construct()
    {
        parent::__construct();
    }


    /**
     * @param $contextid
     * @return mixed
     */
    function get_courseid_by_context($contextid)
    {
        $query = "select * from mdl_context where id=$contextid and contextlevel=50";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $courseid = $row['instanceid'];
        }
        return $courseid;
    }

    /**
     * @param $courseid
     * @return mixed
     */
    function get_coursename($courseid)
    {
        $query = "select * from mdl_course where id=$courseid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['fullname'];
        }
        return $name;
    }


    /**
     * @param $userid
     * @return string
     */
    function get_student_courses($userid)
    {
        $list = "";
        $list .= "<select id='user_courses' style='width: 675px;'>";
        $list .= "<option value='0' selected>Please select</option>";
        $query = "select * from  mdl_role_assignments where roleid=5 and userid=$userid";
        $num = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $courseid = $this->get_courseid_by_context($row['contextid']);
                $coursename = $this->get_coursename($courseid);
                $list .= "<option value='$courseid'>$coursename</option>";
            }
        } // end if $num>0
        $list .= "</select>";
        return $list;
    }


    /**
     * @param $type
     * @return string
     */
    function get_suggest_dialog_title($type)
    {
        switch ($type) {
            case 1:
                $title = 'Suggest Content';
                break;
            case 2:
                $title = 'Suggest Teacher';
                break;
            case 3:
                $title = 'Send Proposal';
                break;
        }
        return $title;
    }


    /**
     * @param $type
     * @return string
     */
    function get_suggest_dialog($type)
    {
        $list = "";
        $userid = $this->user->id;
        $courses = $this->get_student_courses($userid);
        $title = $this->get_suggest_dialog_title($type);

        $list .= "<div class='panel panel-default'>
                    <div class='modal-footer'><div class='title'>$title</div></div>
                    <div class='panel-body'> 
                    <input type='hidden' id='userid' value='$userid'>
                    <input type='hidden' id='type' value='$type'>
                 <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                 <span class='col-md-3'>Course*</span>
                 <span class='col-md-6'>$courses</span>
                 </div>
                
                 <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                 <span class='col-md-3'>Message*</span>
                 <span class='col-md-6'><textarea id='suggest_text' style='width:675px;'></textarea></span>
                 </div>
                
                 <div class='row'>
                 <span class='col-md-3'></span>
                 <span class='col-md-6' id='suggest_err' style='color: red;width: 885px;margin-left: 15px;'></span>
                 </div>
              
                 <div class='modal-footer'>
                   <button type='button' class='btn btn-primary' id='send_student_suggest'>Send</button>
                 </div>
                   
                </div>
            </div>";

        return $list;
    }


    /**
     * @param $item
     */
    function add_student_suggest($item)
    {
        $now = time();
        $query = "insert into mdl_suggest (courseid,userid,type,msg,added) 
                values ($item->courseid,$item->userid,$item->type, '$item->msg', '$now')";
        $this->db->query($query);
    }

    /**
     * @return string
     */
    function get_feedback_dialog()
    {
        $list = "";
        $userid = $this->user->id;

        $list .= "<div class='panel panel-default'>
                    <div class='modal-footer'><div class='title'>Send Feedback</div></div>
                    <div class='panel-body'> 
                    <input type='hidden' id='userid' value='$userid'>
                    
                    <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                    <span class='col-md-3'>Message*</span>
                    <span class='col-md-6'><textarea id='feedback_text' cols='65'></textarea></span>
                    </div>
                
                    <div class='row'>
                    <span class='col-md-3'></span>
                    <span class='col-md-6' id='feedback_err' style='color: red;width: 885px;margin-left: 15px;'></span>
                    </div>
                
              
                    <div class='modal-footer'>
                    <button type='button' class='btn btn-primary' id='send_student_feedback'>Send</button>
                    </div>
                  
                </div>
            </div>";

        return $list;
    }


    function get_student_feedback_page()
    {
        $list = "";
        $userid = $this->user->id;
        $list .= "<div class='panel panel-default'>
                    <div class='modal-footer'><div class='title'>Attach Resume</div></div>
                    <div class='panel-body'> 
                    <input type='hidden' id='userid' value='$userid'>
                    
                    <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                    <span class='col-md-3'>Please attach resume*</span>
                    <span class='col-md-6'><input type='file' id='resume_file' multiple></span>
                    </div>
                
                    <div class='row'>
                    <span class='col-md-3'></span>
                    <span class='col-md-6' id='resume_err' style='color: red;width: 885px;margin-left: 15px;'></span>
                    </div>
                
                    <div class='modal-footer'>
                    <button type='button' class='btn btn-primary' id='attach_resume'>Attach</button>
                    </div>
                  
                </div>
            </div>";

        return $list;
    }

    /**
     * @param $item
     */
    function add_student_feedback($item)
    {
        $userdata = $this->get_user_details($item->userid);
        $userdata->text = $item->text;
        $now = time();
        $name = $userdata->fisratname . ' ' . $userdata->lastname;
        $email = $userdata->email;
        $phone = $userdata->phone1;
        $msg = $userdata->text;
        $query = "insert into mdl_contact_requests (name,email,phone,msg,added) 
                  values ('$name','$email','$phone','$msg',$now)";
        $this->db->query($query);
        $this->send_student_feedback($userdata);
    }

    /**
     * @param $userdata
     * @return bool
     */
    function send_student_feedback($userdata)
    {
        $list = "";

        $name = $userdata->fisratname . ' ' . $userdata->lastname;
        $email = $userdata->email;
        $phone = $userdata->phone1;
        $msg = $userdata->text;

        $list .= "<html>";
        $list .= "<body>";

        $list .= "<br>";
        // $img_path = 'https://' . $_SERVER['SERVER_NAME'] . '/assets/img/logo.png';
	    $img_path = 'http://' . $_SERVER['SERVER_NAME'] . '/clientes/drops/assets/img/logo.png';
        $img = "<img src='$img_path'>";
        $list .= "<table>";

        $list .= "<tr>";
        $list .= "<td style='text-align: center; padding: 15px;' colspan='2'>$img</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='padding: 15px;'>Student name</td>";
        $list .= "<td style='padding: 15px;'>$name</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='padding: 15px;'>Student email</td>";
        $list .= "<td style='padding: 15px;'>$email</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='padding: 15px;'>Student phone</td>";
        $list .= "<td style='padding: 15px;'>$phone</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='padding: 15px;'>Student message</td>";
        $list .= "<td style='padding: 15px;'>$msg</td>";
        $list .= "</tr>";

        $list .= "</table>";
        $list .= "</body>";
        $list .= "</html>";

        $mail = new PHPMailer();

        $addressA = 'sirromas@gmail.com';

        $mail->isSMTP();
        $mail->Host = $this->mail_smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $this->mail_smtp_user;
        $mail->Password = $this->mail_smtp_pwd;
        $mail->SMTPSecure = 'tls';
        $mail->Port = $this->mail_smtp_port;
        $mail->setFrom($this->mail_smtp_user, 'Learning Drops');

        $mail->AddAddress($addressA);

        $mail->addReplyTo($this->mail_smtp_user, 'Learning Drops');
        $mail->isHTML(true);
        $mail->Subject = 'Learning Drops - Students Feedback';
        $mail->Body = $list;
        if (!$mail->send()) {
            return false;
        } // end if !$mail->send()
        else {
            return true;
        }
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

    function upload_resume($post, $file)
    {
        $userid = $post['userid'];
        $file_data = $file[0];
        if ($file_data['error'] == 0 && $file_data['size'] > 0) {
            $filename = 'resume_' . time();
            $upload_path = $_SERVER['DOCUMENT_ROOT'] . "/clientes/drops/lms/custom/feedback/resume/$filename";
            if (move_uploaded_file($file_data['tmp_name'], $upload_path)) {
                $now = time();
                $query = "insert into mdl_students_resume (userid, path, added)  
                        values ($userid, '$filename', '$now')";
                $this->db->query($query);
            } // end if move_uploaded_file
        } // end if $file_data['error']==0 && $file_data['size']>0
    }


}