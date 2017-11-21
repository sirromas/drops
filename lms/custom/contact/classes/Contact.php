<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/utils/classes/Utils.php';

class Contact extends Utils
{

    /**
     * Contact constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    function get_edit_page()
    {
        $list = "";
        $query = "select * from mdl_contact_page";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['company_name'];
            $addr = $row['company_addr'];
            $email = $row['company_email'];
            $phone = $row['company_phone'];
        }

        $list .= "<div class='row' style='margin-bottom: 10px;'>";
        $list .= "<span class='span9'><input type='text' id='name' value='$name' style='width: 100%'></span>";
        $list .= "</div>";

        $list .= "<div class='row'>";
        $list .= "<span class='span9'><textarea id='addr'>$addr</textarea><script>
                CKEDITOR.replace( 'addr' );
            </script></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='margin-top: 10px;margin-bottom: 10px;'>";
        $list .= "<span class='span9'><input type='text' id='email' value='$email' style='width: 100%'></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='margin-bottom: 10px;'>";
        $list .= "<span class='span9'><input type='text' id='phone' value='$phone' style='width: 100%'></span>";
        $list .= "</div>";

        $list .= "<div class='row' style='margin-bottom: 10px;'>";
        $list .= "<span class='span12' id='contact_err' style='color: red;'></span>";
        $list .= "</div>";

        $list .= "<div class='row'>";
        $list .= "<span class='span3'><button class='btn btn-primary' id='update_company_info'>Update</button></span>";
        $list .= "</div>";

        return $list;
    }

    /**
     * @param $item
     * @return string
     */
    function update_contact_page($item)
    {
        $query = "update mdl_contact_page 
                  set company_name='$item->name', 
                  company_addr='$item->addr', 
                  company_email='$item->email', 
                  company_phone='$item->phone'";
        $this->db->query($query);
        $list = "Data are successfully updated";
        return $list;
    }
}