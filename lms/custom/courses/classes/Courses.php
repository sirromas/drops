<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/utils/classes/Utils.php';

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
                $dest = $_SERVER["DOCUMENT_ROOT"] . "/clientes/drops/assets/img/$path";
                $ui_path = "http://" . $_SERVER['SERVER_NAME'] . "/clientes/drops/assets/img/$path";
                $status = move_uploaded_file($tmp_name, $dest);
                if ($status) {
                    $query = "update mdl_course set img_path='$ui_path' where id=$id";
                    $this->db->query($query);
                } // end if ststus
            } // end if $error==0 && $size>0
        } // end if count($file_data)>0
    }


}