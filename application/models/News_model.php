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

        $list .= "<br><div style='margin: auto;width:85%;' >";
        $list .= "<div class='row' style=''>";
        $list .= "<div class='panel panel-default'>";
        $list .= "<div class='panel-heading' style='padding-left: 15px;font-weight: bold; '>$title</div>";
        $list .= "<div class='panel-body'>$content</div>";
        $list .= "</div>";
        $list .= "</div></div>";
        return $list;
    }

    public function get_news_page()
    {
        $list = "";
        $news_table = $this->get_news_table();
        $list .= "<br><div style='margin: auto;width:85%;' >";
        $list .= "<div class='row' style=''>";
        $list .= "<div class='panel panel-default'>";
        $list .= "<div class='panel-heading' style='padding-left: 15px;font-weight: bold;background-color: #f5f5f5;border-color: #ddd; '>News</div>";
        $list .= "<div class='panel-body'>$news_table</div>";
        $list .= "</div>";
        $list .= "</div></div>";

        return $list;
    }

    public function get_news_table()
    {
        $list = "";
        $items = array();
        $query = "select * from mdl_news order by added desc";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $items[] = $row;
        } // end foreach
        $list .= $this->create_news_table($items);
        return $list;
    }

    public function prepare_news_item($item)
    {
        $list = "";
        $title = $item->title;
        $limit = $item->chars_limit;
        $link = "http://" . $_SERVER['SERVER_NAME'] . "/clientes/drops/index.php/news/show/$item->id";
        $preface = substr($item->content, 0, $limit) . ' ....';
        $list .= "<div class='row'>";
        $list .= "<span class='col-md-12' style='font-weight: bold;'><a href='$link'>$title</a></span>";
        $list .= "</div>";
        $list .= "<div class='row'>";
        $list .= "<span class='col-md-12' style='text-align: justify;'>$preface</span>";
        $list .= "</div>";
        return $list;
    }

    public function create_news_table($items)
    {
        $list = "";

        if (count($items) > 0) {
            foreach ($items as $item) {
                $date = date('m-d-Y', $item->added);
                $newsitem = $this->prepare_news_item($item);
                $list .= "<div class='row'>";
                $list .= "<span class='col-md-2'>$date</span><span class='col-md-10'>$newsitem</span>";
                $list .= "</div>";
            } // end foreach
        } // end if count($items)>0

        return $list;
    }

}