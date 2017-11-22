<?php

class Register_model extends CI_Model
{


    /**
     * Register_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @return string
     */
    public function get_categories_list()
    {
        $list = "";
        $list .= "<select id='course_categories' style='width:275px;'>";
        $list .= "<option value='0' selected>Please select category</option>";
        $query = "select * from mdl_course_categories order by name";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $id = $row->id;
            $name = $row->name;
            $list .= "<option value='$id'>$name</option>";
        }
        $list .= "</select>";
        return $list;
    }


    /**
     * @param int $catid
     * @return string
     */
    public function get_category_courses($catid = 0)
    {
        $list = "";
        $list .= "<select id='courses' style='width: 275px;'>";
        $list .= "<option value='0' selected>Please select course</option>";
        if ($catid > 0) {
            $query = "select * from mdl_course where category=$catid";
            $result = $this->db->query($query);
            foreach ($result->result() as $row) {
                $id = $row->id;
                $name = $row->fullname;
                $list .= "<option value='$id'>$name</option>";
            } // end foreach
        } // end if $catid>0
        $list .= "</select>";
        return $list;
    }

    /**
     * @param $data
     */
    public function get_paypal_button($data)
    {

    }

    /**
     * @return string
     */
    public function get_terms_modal_box()
    {
        $list = "";
        $query = "select * from mdl_site_pages where id=4";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $content = $row->content;
        }

        $list .= "<div id='myModal' class='modal fade' role='dialog'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>Acceptance Terms</h4>
              </div>
              <div class='modal-body' style=''>$content</div>
              <div class='modal-footer' style='text-align: center;'>
                <button type='button' class='btn btn-primary' id='course_cancel_dialog'>I Agree</button>
              </div>
            </div>
          </div>
        </div>";


        return $list;
    }

    /**
     * @return string
     */
    public function get_no_course_register_page()
    {
        $list = "";
        $categories = $this->get_categories_list();
        $courses = $this->get_category_courses();

        $list .= "<br><div style='margin: auto;width:85%;' >";
        $list .= "<div class='row' style=''>";
        $list .= "<div class='panel panel-default'>";
        $list .= "<div class='panel-heading' style='padding-left: 30px;font-weight: bold;background-color: #f5f5f5;border-color: #ddd;'>Program information</div>";
        $list .= "<div class='panel-body'>";
        // -------------------- Course selection section --------------------
        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<span class='col-md-2'>Program Category</span>";
        $list .= "<span class='col-md-3'>$categories</span>";
        $list .= "<span class='col-md-2'>Program Course</span>";
        $list .= "<span class='col-md-3' id='courses_span'>$courses</span>";
        $list .= "</div>";
        // ----------------------------------------------------------------
        $list .= "<div class='panel-heading' style='padding-left: 15px;font-weight: bold; '>User Details</div>";
        // -------------------- User details section --------------------
        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<span class='col-md-2'>Name*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='name' style='width: 275px;' required></span>";
        $list .= "<span class='col-md-2'>Email*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='email' style='width: 275px;' required></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<span class='col-md-2'>Phone*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='phone' style='width: 275px;' required placeholder='(xx) xxxxx-xxxx'></span>";
        $list .= "<span class='col-md-2'>Address*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='address' style='width: 275px;' required></span>";
        $list .= "</div>";
        // ----------------------------------------------------------------

        $list .= "<div class='row' style='text-align: center;padding-top: 25px; '>";
        $list .= "<span class='col-md-12' id='reg_err' style='color:red;'></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='text-align: center;'>";
        $list .= "<span class='col-md-12'><br></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='text-align: center;'>";
        $list .= "<span class='col-md-12' style='font-weight:bold;'><input type='checkbox' id='terms'> Terms And Conditions</span>";
        $list .= "</div>";

        $list .= "<div class='row' style='text-align: center;>";
        $list .= "<span class='col-md-12'><button id='reg_continue' class='btn btn-primary' disabled>Continue</button></span>";
        $list .= "</div>";

        $list .= "</div>"; // end of panel body
        $list .= "</div>"; // end of panel defau;t


        /// Panel close div
        $list .= "</div>"; // end of div class=row
        $list .= "</div>"; // end of external div

        return $list;
    }

    /**
     * @param $id
     * @return string
     */
    public function get_course_register_page($id)
    {
        $list = "";
        $data=$this->get_course_data($id);
        $course_name=$data->name;

        $list .= "<br><div style='margin: auto;width:85%;' >";
        $list .= "<div class='row' style=''>";
        $list .= "<div class='panel panel-default'>";
        $list .= "<div class='panel-heading' style='padding-left: 30px;font-weight: bold;background-color: #f5f5f5;border-color: #ddd; '>Program information</div>";
        $list .= "<div class='panel-body'>";
        // -------------------- Course selection section --------------------
        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list.="<input type='hidden' id='courses' value='$id'>";
        $list .= "<span class='col-md-2'>Selected Item</span>";
        $list .= "<span class='col-md-3'>$course_name</span>";
        $list .= "</div>";
        // ----------------------------------------------------------------
        $list .= "<div class='panel-heading' style='padding-left: 15px;font-weight: bold; '>User Details</div>";
        // -------------------- User details section --------------------
        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<span class='col-md-2'>Name*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='name' style='width: 275px;' required></span>";
        $list .= "<span class='col-md-2'>Email*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='email' style='width: 275px;' required></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<span class='col-md-2'>Phone*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='phone' style='width: 275px;' required placeholder='(xx) xxxxx-xxxx'></span>";
        $list .= "<span class='col-md-2'>Address*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='address' style='width: 275px;' required></span>";
        $list .= "</div>";
        // ----------------------------------------------------------------

        $list .= "<div class='row' style='text-align: center;padding-top: 25px; '>";
        $list .= "<span class='col-md-12' id='reg_err' style='color:red;'></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='text-align: center;'>";
        $list .= "<span class='col-md-12'><br></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='text-align: center;'>";
        $list .= "<span class='col-md-12' style='font-weight:bold;'><input type='checkbox' id='terms'> Terms And Conditions</span>";
        $list .= "</div>";

        $list .= "<div class='row' style='text-align: center;>";
        $list .= "<span class='col-md-12'><button id='reg_continue' class='btn btn-primary' disabled>Continue</button></span>";
        $list .= "</div>";

        $list .= "</div>"; // end of panel body
        $list .= "</div>"; // end of panel defau;t


        /// Panel close div
        $list .= "</div>"; // end of div class=row
        $list .= "</div>"; // end of external div

        return $list;
    }

    /**
     * @param $id
     * @return stdClass
     */
    public function get_course_data($id)
    {
        $query = "select * from mdl_course where id=$id";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $course = new stdClass();
            $course->id = $id;
            $course->name = $row->fullname;
            $course->cost = $row->cost;
        }
        return $course;
    }

    public function get_paypal_register_button($data)
    {
        $list = "";


        $list .= "<input type='hidden' name='item_name' value=''>
        <input type='hidden' name='amount' value=''>
        <input type='hidden' name='custom' value=''>    
        <INPUT TYPE='hidden' NAME='currency_code' value='BRL'>    
        <INPUT TYPE='hidden' NAME='return' value='http://" . $_SERVER['SERVER_NAME'] . "/clientes/drops/index.php/register/payment_done'>
        <input type='image' id='paypal_btn' src='https://www.sandbox.paypal.com/en_US/i/btn/btn_buynow_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
        <img alt='' border='0' src='https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
        </form>";

        return $list;
    }


    /**
     * @param $data
     * @return string
     */
    public function get_order_confirmation_page($data)
    {
        $list = "";
        $item = json_decode(base64_decode($data));
        $course = $this->get_course_data($item->courseid);
        $paypalbtn = $this->get_paypal_register_button($item);

        $list .= "<br><div style='margin: auto;width:85%;' >";
        $list .= "<div class='panel panel-default'>";
        $list .= "<div class='panel-heading' style='padding-left: 30px;font-weight: bold; background-color: #f5f5f5;border-color: #ddd; '>Order confirmation</div>";
        $list .= "<div class='panel-body'>";

        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<span class='col-md-2'>Selected Item</span>";
        $list .= "<span class='col-md-2'>$course->name</span>";
        $list .= "<span class='col-md-2'>Amount to pay</span>";
        $list .= "<span class='col-md-2'>$course->cost BRL</span>";
        $list .= "<span class='col-md-2'>$paypalbtn</span>";
        $list .= "</div>";

        $list .= "</div>";
        $list .= "</div>";
        $list .= "</div>";

        return $list;
    }

    /**
     * @param $data
     * @return string
     */
    public function get_payment_confirmation_page($data)
    {
        $list = "";

        return $list;
    }

}
