<?php


class Register_model extends CI_Model
{

    public $enroll_url;

    /**
     * Register_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->enroll_url = 'http://' . $_SERVER['SERVER_NAME'] . '/lms/custom/enroll/user.php';
    }

    /**
     * @return string
     */
    public function get_categories_list()
    {
        $list = "";
        $list .= "<select id='course_categories' style='width:275px;'>";
        $list .= "<option value='0' selected>Escolha a Categoria</option>";
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
        $list .= "<option value='0' selected>Escolha a Gota</option>";
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
        $list .= "<div class='panel-heading' style='padding-left: 30px;font-weight: bold;background-color: #f5f5f5;border-color: #ddd;'>Informações</div>";
        $list .= "<div class='panel-body'>";
        // -------------------- Course selection section --------------------
        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<span class='col-md-2'>Escola a Instituição</span>";
        $list .= "<span class='col-md-3'>$categories</span>";
        $list .= "<span class='col-md-2'>Escolha a Gota</span>";
        $list .= "<span class='col-md-3' id='courses_span'>$courses</span>";
        $list .= "</div>";
        // ----------------------------------------------------------------
        $list .= "<div class='panel-heading' style='padding-left: 15px;font-weight: bold; '>Informações do Usuário</div>";
        // -------------------- User details section --------------------
        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<span class='col-md-2'>Nome Completo*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='name' style='width: 275px;' required></span>";
        $list .= "<span class='col-md-2'>E-mail*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='email' style='width: 275px;' required></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<span class='col-md-2'>Telefone*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='phone' style='width: 275px;' required placeholder='(xx) xxxxx-xxxx'></span>";
        $list .= "<span class='col-md-2'>Endereço*</span>";
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
        $list .= "<span class='col-md-12' style='font-weight:bold;'><input type='checkbox' id='terms'> Termos e Condições</span>";
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
        $data = $this->get_course_data($id);
        $course_name = $data->name;

        $list .= "<br><div style='margin: auto;width:85%;' >";
        $list .= "<div class='row' style=''>";
        $list .= "<div class='panel panel-default'>";
        $list .= "<div class='panel-heading' style='padding-left: 30px;font-weight: bold;background-color: #f5f5f5;border-color: #ddd; '>Informações</div>";
        $list .= "<div class='panel-body'>";
        // -------------------- Course selection section --------------------
        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<input type='hidden' id='courses' value='$id'>";
        $list .= "<span class='col-md-2'>Item Selecionado</span>";
        $list .= "<span class='col-md-3'>$course_name</span>";
        $list .= "</div>";
        // ----------------------------------------------------------------
        $list .= "<div class='panel-heading' style='padding-left: 15px;font-weight: bold; '>Informações do Usuário</div>";
        // -------------------- User details section --------------------
        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<span class='col-md-2'>Nome Completo*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='name' style='width: 275px;' required></span>";
        $list .= "<span class='col-md-2'>E-mail*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='email' style='width: 275px;' required></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<span class='col-md-2'>Telefone*</span>";
        $list .= "<span class='col-md-3'><input type='text' id='phone' style='width: 275px;' required placeholder='(xx) xxxxx-xxxx'></span>";
        $list .= "<span class='col-md-2'>Endereço*</span>";
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
        $list .= "<span class='col-md-12' style='font-weight:bold;'><input type='checkbox' id='terms'>Termos e Condições</span>";
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

    /**
     * @param $data
     * @return string
     */
    public function get_sandbox_paypal_button($data)
    {
        $list = "";
        $coursedata = $this->get_course_data($data->courseid);
        $cost = $coursedata->cost;
        $name = $coursedata->name;
        $email = $data->email;

        $list .= "<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>
        <input type='hidden' name='cmd' value='_xclick'>
        <INPUT TYPE='hidden' name='charset' value='utf-8'>
        <input type='hidden' name='business' value='sirromas-facilitator@gmail.com'>
        <input type='hidden' name='item_name' value='$name'>
        <input type='hidden' name='amount' value='$cost'>
        <input type='hidden' name='custom' value='$email'>    
        <INPUT TYPE='hidden' NAME='currency_code' value='BRL'>    
        <INPUT TYPE='hidden' NAME='return' value='http://" . $_SERVER['SERVER_NAME'] . "/index.php/register/payment_done'>
        <input type='image' id='paypal_btn' src='https://learningindrops.com/assets/img/buynow.png' width='175' height='35' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
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
        $paypalbtn = $this->get_sandbox_paypal_button($item);

        $list .= "<br><div style='margin: auto;width:85%;' >";
        $list .= "<div class='panel panel-default'>";
        $list .= "<div class='panel-heading' style='padding-left: 30px;font-weight: bold; background-color: #f5f5f5;border-color: #ddd; '>Confirmação do Pedido</div>";
        $list .= "<div class='panel-body'>";

        $list .= "<div class='row' style='padding-left: 15px;'>";
        $list .= "<span class='col-md-2'>Item Selecionado</span>";
        $list .= "<span class='col-md-2'>$course->name</span>";
        $list .= "<span class='col-md-2'>Valor a Pagar: R$</span>";
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
        $session_data = $_SESSION['email'];
        $stdata = json_decode(base64_decode($session_data));

        $courseid = $stdata->courseid;
        $name = $stdata->name;
        $email = $stdata->email;
        $phone = $stdata->phone;
        $address = $stdata->address;
        $amount = $data['amt'];
        $transactionid = $data['tx'];

        $names = explode(' ', $name);
        $fname = $names[0];
        $lname = $names[1];

        $user = new stdClass();
        $user->courseid = $courseid;
        $user->name = $name;
        $user->fname = $fname;
        $user->lname = $lname;
        $user->email = $email;
        $user->phone = $phone;
        $user->address = $address;
        $user->amount = $amount;
        $user->transactionid = $transactionid;

        $huser = base64_encode(json_encode($user));
        $http_path = $this->enroll_url . "?user=$huser";
        $userid = file_get_contents($http_path);

        if ($userid > 0) {
            $status = 0;
            $list .= "<br><div style='margin: auto;width:85%;' >";
            $list .= "<div class='panel panel-default'>";
            $list .= "<div class='panel-heading' style='padding-left: 30px;font-weight: bold; background-color: #f5f5f5;border-color: #ddd; '>Payment confirmation</div>";
            $list .= "<div class='panel-body'>";
            $list .= "<div class='row' style='padding-left: 15px;'>";
            $list .= "<span class='col-md-12'>Thank you for your order! Confirmation email is sent to <span style='font-weight: bold;'>$email</span></span>";
            $list .= "</div>";
            $list .= "</div>";
            $list .= "</div>";
            $list .= "</div>";
        } // end if $userid>0
        else {
            $status = -1;
            $list .= "<br><div style='margin: auto;width:85%;' >";
            $list .= "<div class='panel panel-default'>";
            $list .= "<div class='panel-heading' style='padding-left: 30px;font-weight: bold; background-color: #f5f5f5;border-color: #ddd; '>Payment status</div>";
            $list .= "<div class='panel-body'>";
            $list .= "<div class='row' style='padding-left: 15px;'>";
            $list .= "<span class='col-md-12'>Sign-up Error Happened. Please contact support team <span style='font-weight: bold;'>info@theberry.us</span></span>";
            $list .= "</div>";
            $list .= "</div>";
            $list .= "</div>";
            $list .= "</div>";
        }

        $data = array('page' => $list, 'status' => $status, 'user' => $user);
        return $data;
    }


    /**
     * @param $user
     * @return string
     */
    public function get_registration_confirmation_email($user)
    {
        $list = "";
        $course = $this->get_course_data($user->courseid);
        $coursename = $course->name;
        $username = $user->email;
        $pwd = 'strange12';

        $list .= "<html>";
        $list .= "<body>";

        $list .= "<br>";
        $img_path = 'http://' . $_SERVER['SERVER_NAME'] . '/assets/img/logo.png';
        $img = "<img src='$img_path'>";
        $list .= "<table>";

        $list .= "<tr>";
        $list .= "<td style='text-align: center; padding: 15px;' colspan='2'>$img</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='text-align: center; padding: 15px;' colspan='2'>Dear $user->fname $user->lname! Thank you for signup. </td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='text-align: center; padding: 15px;' colspan='2'>This receipt is confirmation of your successfull registration.</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='padding: 15px;'>Your username</td>";
        $list .= "<td>$username</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='padding: 15px;'>Your password</td>";
        $list .= "<td>$pwd</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='padding: 15px;'>Your course (program)</td>";
        $list .= "<td>$coursename</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='padding: 15px;'>Amount paid (BRL)</td>";
        $list .= "<td>$user->amount</td>";
        $list .= "</tr>";

        $list .= "<tr>";
        $list .= "<td style='padding: 15px;' colspan='2'>Best regards, Learning Drops Team <a href='mailto:info@theberry.us'>info@theberry.us</a></td>";
        $list .= "</tr>";

        $list .= "</table>";

        $list .= "</body>";
        $list .= "</html>";

        return $list;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function is_email_exists($email)
    {
        $query = "select * from mdl_user where username='$email'";
        $result = $this->db->query($query);
        $num = $result->num_rows();
        return $num;
    }

}
