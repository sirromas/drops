<?php

class Logos_model extends CI_Model
{


    /**
     * Logos_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    /**
     * @return string
     */
    public function get_logos_page()
    {
        $list = "";
        $query = "select * from mdl_site_pages where id=6";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $content = $row->content;
        }
        $list .= "<br><div style='margin: auto;width:85%;' >";
        $list .= "<div class='row' style=''>";
        $list .= "<div class='panel panel-default'>";
        $list .= "<div class='panel-heading' style='padding-left: 15px;font-weight: bold;background-color: #f5f5f5; border-color: #ddd; '>Logos parceiras</div>";
        $list .= "<div class='panel-body'>$content</div>";
        $list .= "</div>";
        $list .= "</div></div>";
        return $list;
    }


}