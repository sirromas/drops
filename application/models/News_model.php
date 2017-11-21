<?php

class News_model extends CI_Model
{


    /**
     * News_model constructor.
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
    public function get_news_content($id)
    {
        $list = "";
        $query = "select * from mdl_news where id=$id";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $title = $row->title;
            $content = $row->content;
        }

        $list .="<br><div style='margin: auto;width:85%;' >";
        $list .= "<div class='row' style=''>";
        $list .= "<div class='panel panel-default'>";
        $list .= "<div class='panel-heading' style='padding-left: 15px;font-weight: bold; '>$title</div>";
        $list .= "<div class='panel-body'>$content</div>";
        $list .="</div>";
        $list .= "</div></div>";
        return $list;
    }

}