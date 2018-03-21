<?php

class Contact_model extends CI_Model
{


    /**
     * Contact_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @return string
     */
    public function get_feedback_form()
    {
        $list = "";

        $list .= "<div style='margin: auto;width:85%;' id='contact_form_container'>";
        $list .= "<div class='panel panel-default'>";

        $list .= "<div class='panel-body'>";

        $list .= "<div class='form-group' style='text-align:left;'>";
        $list .= "<label for='name'>Nome*</label>";
        $list .= "<input type='text' class='form-control' id='name' style='width:100%;'>";
        $list .= "</div>";

        $list .= "<div class='form-group' style='text-align:left;'>";
        $list .= "<label for='email'>E-mail*</label>";
        $list .= "<input type='text' class='form-control' id='email' style='width:100%;'>";
        $list .= "</div>";

        $list .= "<div class='form-group' style='text-align:left;'>";
        $list .= "<label for='phone'>Telefone*</label>";
        $list .= "<input type='text' class='form-control' id='phone' style='width:100%;'>";
        $list .= "</div>";

        $list .= "<div class='form-group' style='text-align:left;'>";
        $list .= "<label for='email'>Mensagem*</label>";
        $list .= "<textarea class='form-control' id='msg' rows='5' style='width:100%;'></textarea>";
        $list .= "</div>";

        $list .= "<div class='form-group' style='text-align:left;color:red;' id='contact_err' ></div>";

        $list .= "<div class='form-group' style='text-align:left;'>";
        $list .= "<button id='send_contact_request' class='btn btn-primary'>Enviar</button>";
        $list .= "</div>";

        $list .= "</div>";
        $list .= "</div>";
        $list .= "</div>";


        return $list;
    }

    /**
     * @return string
     */
    public function get_contact_info()
    {
        $query = "select * from mdl_contact_page";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $name = $row->company_name;
            $addr = $row->company_addr;
            $email = $row->company_email;
            $phone = $row->company_phone;
        }
        $list = "";

        $list .= "<div class='row' style='margin-bottom: 25px;'>";
        $list .= "<span class='col-md-1'><i class='fa fa-envelope fa-lg' aria-hidden='true'></i></span>";
        $list .= "<span class='col-md-4'><span style='font-weight: bold;'>E-mail</span><br><a href='mailto:$email'>$email</a></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='margin-bottom: 25px;'>";
        $list .= "<span class='col-md-1'><i class='fa fa-phone fa-lg' aria-hidden='true'></i></span>";
        $list .= "<span class='col-md-4'><span style='font-weight: bold;'>Telefone</span><br>$phone</span>";
        $list .= "</div>";

        $list .= "<div class='row' style='margin-bottom: 25px;'>";
        $list .= "<span class='col-md-1'><i class='fa fa-flag fa-lg' aria-hidden='true'></i></span>";
        $list .= "<span class='col-md-6'><span style='font-weight: bold;'>Endereço</span><br>$name<br>$addr</span>";
        $list .= "</div>";

        return $list;
    }

    /**
     * @return string
     */
    public function get_contact_page()
    {
        $list = '';
        $form = $this->get_feedback_form();
        $info = $this->get_contact_info();
        $list .= "<br><div style='margin: auto;width:85%;' >";
        $list .= "<div class='panel panel-default'>";
        $list .= "<div class='panel-heading' style='padding-left: 30px;font-weight: bold;background-color: #f5f5f5;border-color: #ddd; '>Fale Conosco</div>";
        $list .= "<div class='panel-body'>";

        $list .= "<div class='row'>";
        $list .= "<span class='col-md-6'>$form</span>";
        $list .= "<span class='col-md-6'>$info</span>";
        $list .= "</div>";

        $list .= "</div>";
        $list .= "</div>";
        $list .= "</div>";
        return $list;
    }

    /**
     * @param $item
     * @return string
     */
    public function add_contact_request($item)
    {
        $data = json_decode($item);
        $name = $data->name;
        $email = $data->email;
        $phone = $data->phone;
        $msg = $data->msg;
        $now = time();
        $query = "insert into mdl_contact_requests (name,email,phone,msg,added) 
                  values('$name','$email','$phone','$msg','$now')";
        $this->db->query($query);
        $list = "Thank you for contacting us. We get back to you soon!";
        return $list;
    }


}