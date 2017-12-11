<?php

class About_model extends CI_Model
{


    /**
     * About_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @param $id
     * @return string
     */
    public function get_about_content()
    {
        $list = "";
        $query = "select * from mdl_site_pages where id=1";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $content = $row->content;
        }

        $list .= "<br><div style='margin: auto;width:85%;' >";
        $list .= "<div class='row' style=''>";
        $list .= "<div class='panel panel-default'>";
        $list .= "<div class='panel-heading' style='padding-left: 15px;font-weight: bold; '>Quem somos nós?</div>";
        $list .= "<div class='panel-body'>$content</div>";
        $list .= "</div>";
        $list .= "</div></div>";
        return $list;
    }

}