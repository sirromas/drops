<?php

//require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/custom/utils/classes/Utils.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/custom/enroll/classes/Enroll.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/utils/classes/Utils.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/enroll/classes/Enroll.php';

class Courses extends Utils
{

    /**
     * Courses constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $catname
     * @return mixed
     */
    function get_course_category_id($catname)
    {
        $query = "select * from mdl_course_categories where name='$catname'";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
        }
        return $id;
    }

    /**
     * @param $catid
     * @return mixed
     */
    function get_course_category_name($catid)
    {
        $query = "select * from mdl_course_categories where id='$catid'";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['name'];
        }
        return $name;
    }

    /**
     * @param $courseid
     * @return string
     */
    function get_course_enrollment_methods($courseid)
    {
        $query = "select * from mdl_enrol where courseid=$courseid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $ids[] = $row['id'];
        }
        $ids_list = implode(',', $ids);
        return $ids_list;
    }

    /**
     * @param $courseid
     * @return int
     */
    function get_course_users_num($courseid)
    {
        $enrollments_list = $this->get_course_enrollment_methods($courseid);
        $query = "select * from mdl_user_enrolments where enrolid in ($enrollments_list)";
        $num = $this->db->numrows($query);
        return $num;
    }

    /**
     * @param $id
     * @return string
     */
    function get_ops_items($id)
    {
        $list = "";
        $list .= "<span >&nbsp;&nbsp;&nbsp;";
        $list .= "<i id='course_edit_$id' style='cursor: pointer;' class='fa fa-pencil-square-o' aria-hidden='true'></i>";
        $list .= "</span>&nbsp;&nbsp;&nbsp;";
        return $list;
    }

    /**
     * @param $path
     * @return string
     */
    function get_course_thumb($path)
    {
        $list = "";
        if ($path == '') {
            $list .= "N/A";
        } // end if
        else {
            $list .= "<a href='$path' target='_blank'><img src='$path' width='100' height='30'></a>";
        } // end else
        return $list;
    }


    /**
     * @param null $catname
     * @return string
     */
    function get_courses_list($catname = null)
    {
        $list = "";

        $list .= "<div class='row' style='margin-bottom: 175px;'>";
        $list .= "<table id='courses_table' class='display' cellspacing='0' width='100%'>";
        $list .= "<thead>";
        $list .= "<tr>";
        $list .= "<th>Course Name</th>";
        $list .= "<th>Owner</th>";
        $list .= "<th>Total Enrolled</th>";
        $list .= "<th>Thumb</th>";
        $list .= "<th>Top course</th>";
        $list .= "<th>Cost</th>";
        $list .= "<th>Ops</th>";
        $list .= "</tr>";
        $list .= "</thead>";

        if ($catname == null) {
            $query = "select * from mdl_course where category>0";
        } // end if
        else {
            $catid = $this->get_course_category_id($catname);
            $query = "select * from mdl_course where category=$catid";
        } // end else
        $num = $this->db->numrows($query);
        $list .= "<tbody>";
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                //$url = 'https://' . $_SERVER['SERVER_NAME'] . "/lms/course/view.php?id=$id";
	            $url = 'http://' . $_SERVER['SERVER_NAME'] . "/clientes/drops/lms/course/view.php?id=$id";
                $name = $row['fullname'];
                $link = "<a href='$url' target='_blank'>$name</a>";
                $catname = $this->get_course_category_name($row['category']);
                $path = $this->get_course_thumb($row['img_path']);
                $top = ($row['top'] == 0) ? 'No' : 'Yes';
                $total_enrolled = $this->get_course_users_num($id);
                $cost = $row['cost'];
                $ops = $this->get_ops_items($id);
                $list .= "<tr>";
                $list .= "<td>$link</td>";
                $list .= "<td>$catname</td>";
                $list .= "<td>$total_enrolled</td>";
                $list .= "<td>$path</td>";
                $list .= "<td>$top</td>";
                $list .= "<td>$cost BRL</td>";
                $list .= "<td>$ops</td>";
                $list .= "</tr>";
            } // end while
        } // end if $num>0
        $list .= "</tbody>";
        $list .= "</table>";
        $list .= "</div>";

        return $list;
    }

    /**
     * @param $userid
     */
    function get_user_course_category_name($userid)
    {

    }

    /**
     * @return string
     */
    function get_courses_page()
    {
        $userid = $this->user->id;
        $list = "";
        if ($userid == 2) {
            $list .= $this->get_courses_list();
        } // end if
        else {
            $catname = $this->get_user_course_category_name($userid);
            $list .= $this->get_courses_list($catname);
        } // end else
        return $list;
    }

    /**
     * @param $status
     * @return string
     */
    function get_course_top_checkbox($status)
    {
        $list = "";
        if ($status == 1) {
            $list .= "<input type='checkbox' id='top_status' checked>";
        } // end if
        else {
            $list .= "<input type='checkbox' id='top_status' >";
        } // end else
        return $list;
    }

    /**
     * @param $id
     * @return string
     */
    function get_course_edit_dialog($id)
    {
        $list = "";
        $query = "select * from mdl_course where id=$id";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $top = $this->get_course_top_checkbox($row['top']);
            $cost = $row['cost'];
        }

        $list .= "<div id='myModal' class='modal fade' role='dialog'>
          <div class='modal-dialog'>
           <input type='hidden' id='courseid' value='$id'>
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>Edit Course Data</h4>
              </div>
              <div class='modal-body' style=''>
                
                <div class='row' style='margin-bottom:10px;padding-left: 15px; '>
                <span class='col-md-3'>Thumb</span>
                <span class='col-md-4'><input type='file' id='files' accept='image/gif, image/jpeg, image/png'></span>
                </div>
                
                <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                <span class='col-md-3'>Cost* (BRL)</span>
                <span class='col-md-4'><input type='text' id='cost' value='$cost'></span>
                </div>
                
                <div class='row' style='margin-bottom:10px;padding-left:15px;'>
                <span class='col-md-3'>Top Course</span>
                <span class='col-md-4'>$top</span>
                </div>
                
                <div class='row'>
                <span class='col-md-6' id='course_err' style='color: red;width: 885px;margin-left: 15px;'></span>
                </div>
                
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-primary' id='course_update_done'>Update</button>
                <button type='button' class='btn btn-primary' id='course_cancel_dialog'>Cancel</button>
              </div>
            </div>
          </div>
        </div>";

        return $list;
    }

    /**
     * @param $file
     * @param $post
     */
    function update_course_data($file, $post)
    {
        $file_data = $file[0];
        $id = $post['id'];
        $cost = $post['cost'];
        $top = $post['top'];

        $query = "update mdl_course set cost='$cost', top=$top where id=$id";
        $this->db->query($query);

        if (count($file_data) > 0) {
            $tmp_name = $file_data['tmp_name'];
            $error = $file_data['error'];
            $size = $file_data['size'];
            if ($error == 0 && $size > 0) {
                $path = time() . ".jpg";
                //$dest = $_SERVER["DOCUMENT_ROOT"] . "/assets/img/$path";
	            $dest = $_SERVER["DOCUMENT_ROOT"] . "/clientes/drops/assets/img/$path";
                //$ui_path = "https://" . $_SERVER['SERVER_NAME'] . "/assets/img/$path";
	            $ui_path = "http://" . $_SERVER['SERVER_NAME'] . "/clientes/drops/assets/img/$path";
                $status = move_uploaded_file($tmp_name, $dest);
                if ($status) {
                    $query = "update mdl_course set img_path='$ui_path' where id=$id";
                    $this->db->query($query);
                } // end if ststus
            } // end if $error==0 && $size>0
        } // end if count($file_data)>0
    }

    /*************************************************************************************
     *
     *                      Students course ops
     *
     **************************************************************************************/

    function is_course_paid($courseid)
    {
        $query = "select * from mdl_course where id=$courseid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $paid = $row['paid'];
        }
        return $paid;
    }

    /**
     * @param $courseid
     * @return mixed
     */
    function get_course_context($courseid)
    {
        $query = "select * from mdl_context WHERE contextlevel=50 and instanceid=$courseid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $contextid = $row['id'];
        }
        return $contextid;
    }

    /**
     * @param $courseid
     * @param $userid
     * @return mixed
     */
    function get_course_user_role($courseid, $userid)
    {
        $contextid = $this->get_course_context($courseid);
        $query = "select * from  mdl_role_assignments where contextid=$contextid and userid=$userid";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $roleid = $row['roleid'];
        }
        return $roleid;
    }

    /**
     * @param $courseid
     * @param $userid
     * @return int
     */
    function is_subscription_active($courseid, $userid)
    {
        if ($userid != 2) {
            $query = "select * from mdl_paypal_payments where courseid=$courseid and userid=$userid";
            $num = $this->db->numrows($query);
        } // end if
        else {
            $num = 1;
        } // end else
        return $num;
    }

    /**
     * @param $courseid
     * @param $userid
     * @return int
     */
    function has_course_access($courseid, $userid)
    {
        $course_paid = $this->is_course_paid($courseid);
        if ($course_paid == 1) {
            if ($userid != 2) {
                $roleid = $this->get_course_user_role($courseid, $userid);
                if ($roleid == 5) {
                    $status = $this->is_subscription_active($courseid, $userid);
                }  // end if
                else {
                    $status = 1;
                }
            } // end if $userid!=2
            else {
                $status = 1;
            }
        } // end if $course_paid==1
        else {
            $status = 1;
        }
        return $status;
    }

    /**
     * @return string
     */
    function get_categories()
    {
        $list = "";
        $list .= "<select id='categories' style='width: 275px;'>";
        $list .= "<option value='0' selected>Please select</option>";
        $query = "select * from mdl_course_categories order by name";
        $num = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $list .= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            } // end while
        } // end if $num>0
        $list .= "</select>";
        return $list;
    }

    /**
     * @param int $catid
     * @return string
     */
    function get_courses_by_category($catid = 0)
    {
        $list = "";
        $list .= "<select id='available_courses' style='width: 275px;'>";
        $list .= "<option value='0' selected>Please select</option>";
        if ($catid > 0) {
            $query = "select * from mdl_course where category=$catid";
            $num = $this->db->numrows($query);
            if ($num > 0) {
                $result = $this->db->query($query);
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $list .= "<option value='" . $row['id'] . "'>" . $row['fullname'] . "</option>";
                } // end while
            } // end if $num>0
        } // end if $catid>0
        $list .= "</select>";
        return $list;
    }

    /**
     * @return string
     */
    function get_courses_enrollment_dialog()
    {
        $list = "";
        $userid = $this->user->id;
        $categories = $this->get_categories();
        $courses = $this->get_courses_by_category();

        $list.="<div class='panel panel-default'>
                    <div class='modal-footer'>Add new subscription</div>
                    <div class='panel-body'> 
                    <input type='hidden' id='userid' value='$userid'>
                    <div class='row' style='margin-bottom:10px;padding-left: 15px; '>
                <span class='col-md-3'>Category</span>
                <span class='col-md-6'>$categories</span>
                </div>
                
                <div class='row' style='margin-bottom:10px;padding-left: 15px;'>
                <span class='col-md-3'>Course</span>
                <span class='col-md-6' id='courses_container'>$courses</span>
                </div>
                
                <div class='row'>
                <span class='col-md-3'></span>
                <span class='col-md-6' id='course_err' style='color: red;width: 885px;margin-left: 15px;'></span>
                </div>
                
              
                <div class='modal-footer'>
                <button type='button' class='btn btn-primary' id='enroll_to_course'>Subscribe</button>
                </div>
                   
                </div>
            </div>";

        return $list;
    }

    /**
     * @param $item
     */
    function enroll_into_course($item)
    {
        $courseid = $item->courseid;
        $userid = $item->userid;
        $en = new Enroll();
        $en->assign_roles($userid, $courseid);
        purge_all_caches();
    }

    /**
     * @param $id
     * @return stdClass
     */
    function get_course_data($id)
    {
        $query = "select * from mdl_course where id=$id";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $course = new stdClass();
            $course->id = $row['id'];
            $course->name = $row['fullname'];
            $course->cost = $row['cost'];
        }
        return $course;
    }

    /**
     * @param $courseid
     * @param $userid
     * @return string
     */
    function get_production_paypal_btn($courseid, $userid)
    {
        $list = "";
        $coursedata = $this->get_course_data($courseid);
        $cost = $coursedata->cost;
        $name = $coursedata->name;

        $list .= "<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
        <input type='hidden' name='cmd' value='_xclick'>
        <INPUT TYPE='hidden' name='charset' value='utf-8'>
        <input type='hidden' name='business' value='lmcabral2@yahoo.com.br'>
        <input type='hidden' name='item_name' value='$name'>
        <input type='hidden' name='amount' value='$cost'>
        <input type='hidden' name='custom' value='$userid/$courseid'>    
        <INPUT TYPE='hidden' NAME='currency_code' value='BRL'>    
        <INPUT TYPE='hidden' NAME='return' value='https://" . $_SERVER['SERVER_NAME'] . "/index.php/register/payment_student_done'>
        <input type='image' id='paypal_btn' src='https://learningindrops.com/assets/img/buynow.png' width='175' height='35' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
        </form>";

        return $list;
    }

    /**
     * @param $courseid
     * @param $userid
     * @return string
     */
    function get_sanbox_paypal_btn($courseid, $userid)
    {
        $list = "";

        $coursedata = $this->get_course_data($courseid);
        $cost = $coursedata->cost;
        $name = $coursedata->name;

        $list .= "<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>
        <input type='hidden' name='cmd' value='_xclick'>
        <INPUT TYPE='hidden' name='charset' value='utf-8'>
        <input type='hidden' name='business' value='sirromas-facilitator@gmail.com'>
        <input type='hidden' name='item_name' value='$name'>
        <input type='hidden' name='amount' value='$cost'>
        <input type='hidden' name='custom' value='$userid/$courseid'>    
        <INPUT TYPE='hidden' NAME='currency_code' value='BRL'>    
        <INPUT TYPE='hidden' NAME='return' value='https://" . $_SERVER['SERVER_NAME'] . "/index.php/register/payment_student_done'>
        <input type='image' id='paypal_btn' src='https://learningindrops.com/assets/img/buynow.png' width='175' height='35' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
        </form>";

        return $list;
    }


	function get_berry_paypal_btn($courseid, $userid)
	{
		$list = "";

		$coursedata = $this->get_course_data($courseid);
		$cost = $coursedata->cost;
		$name = $coursedata->name;

		$list .= "<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>
        <input type='hidden' name='cmd' value='_xclick'>
        <INPUT TYPE='hidden' name='charset' value='utf-8'>
        <input type='hidden' name='business' value='sirromas-facilitator@gmail.com'>
        <input type='hidden' name='item_name' value='$name'>
        <input type='hidden' name='amount' value='$cost'>
        <input type='hidden' name='custom' value='$userid/$courseid'>    
        <INPUT TYPE='hidden' NAME='currency_code' value='BRL'>    
        <INPUT TYPE='hidden' NAME='return' value='http://" . $_SERVER['SERVER_NAME'] . "/clientes/drops/index.php/register/payment_student_done'>
        <input type='image' id='paypal_btn' src='http://theberry.us/clientes/drops/assets/img/buynow.png' width='175' height='35' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
        </form>";

		return $list;
	}


    /**
     * @param $courseid
     * @param $userid
     * @return string
     */
    function get_student_course_payment_dialog($courseid, $userid)
    {
        $list = "";
        //$paypalbtn = $this->get_production_paypal_btn($courseid, $userid);
        //$paypalbtn = $this->get_sanbox_paypal_btn($courseid, $userid);
	    $paypalbtn=$this->get_berry_paypal_btn($courseid, $userid);
        $list .= "<p>We did not receive payment from you. Please buy subscription using PayPal $paypalbtn</p>";
        return $list;
    }

    /**
     * @return string
     */
    function get_student_subscriptions()
    {
        $list = "";
        $userid = $this->user->id;
        $list .= "<div class='row' style='margin-bottom: 175px;'>";
        $list .= "<table id='subscriptions_table' class='display' cellspacing='0' width='100%'>";
        $list .= "<thead>";
        $list .= "<tr>";
        $list .= "<th>Course Name</th>";
        $list .= "<th>Amount Paid</th>";
        $list .= "<th>Payment Date</th>";
        $list .= "<th>Status</th>";
        $list .= "<th>Ops</th>";
        $list .= "</tr>";
        $list .= "</thead>";

        $list .= "<tbody>";
        $query = "select * from mdl_paypal_payments where userid=$userid and refunded=0";
        $num = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $coursedata = $this->get_course_data($row['courseid']);
                $coursename = $coursedata->name;
                $amount = $row['psum'];
                $date = date('m-d-Y', $row['pdate']);
                $status = ($row['active'] == 1) ? 'Active' : 'Canceled';
                $ops = $this->get_subscription_ops($row['trans_id']);
                $list .= "<tr>";
                $list .= "<td>$coursename</td>";
                $list .= "<td>$amount BRL</td>";
                $list .= "<td>$date</td>";
                $list .= "<td>$status</td>";
                $list .= "<td>$ops</td>";
                $list .= "<tr>";
            } // end while
        } // end if $num>0
        $list .= "</tbody>";

        $list .= "</table>";
        $list .= "</div>";

        return $list;
    }

    /**
     * @param $trans_id
     * @return string
     */
    function get_subscription_ops($trans_id)
    {
        $list = "";
        $list .= "<span >&nbsp;&nbsp;&nbsp;";
        $list .= "<i id='subscription_status_$trans_id' style='cursor: pointer;' class='fa fa-pencil-square-o' aria-hidden='true'></i>";
        $list .= "</span>&nbsp;&nbsp;&nbsp;";
        return $list;
    }

    /**
     * @param $trans_id
     * @return mixed
     */
    function get_subscription_status($trans_id)
    {
        $query = "select * from mdl_paypal_payments where trans_id='$trans_id'";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $status = $row['active'];
        }
        return $status;
    }

    /**
     * @param $trans_id
     */
    function change_student_subscription_status($trans_id)
    {
        $ostatus = $this->get_subscription_status($trans_id);
        $status = ($ostatus == 0) ? '1' : '0';
        $query = "update mdl_paypal_payments set active=$status where trans_id='$trans_id'";
        $this->db->query($query);
    }


}