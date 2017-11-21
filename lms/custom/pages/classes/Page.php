<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/utils/classes/Utils.php';

class Page extends Utils
{

    function __construct()
    {
        parent::__construct();
    }


    /**
     * @param $id
     * @return string
     */
    function get_page_content($id)
    {
        $list = "";
        $query = "select * from mdl_site_pages where id=$id";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $content = $row['content'];
            $title = $row['title'];
        }

        $list .= "<div class='row' style='margin-bottom: 10px;'>";
        $list .= "<input type='hidden' id='pageid' value='$id'>";
        $list .= "<span class='span12' style='padding-left: 0px;'><input type='text' id='page_title' style='width: 100%' placeholder='Page Title' value='$title'></span>";
        $list .= "</div>";

        $list .= "<div class='row'>";
        $list .= "<span class='span12' style=''>";
        $list .= "<textarea name='editor1' id='editor1' rows='15' cols='80'>";
        $list .= $content;
        $list .= "</textarea>";
        $list .= "<script>
                CKEDITOR.replace( 'editor1' );
            </script>";
        $list .= "</span>";
        $list .= "</div>";

        $list .= "<div class='row'>";
        $list .= "<span class='span12' id='page_err' style='color: red;'></span>";
        $list .= "</div>";

        $list .= "<div class='row'>";
        $list .= "<span class='span3'><button class='btn btn-primary' id='update_site_page'>Update</button></span>";
        $list .= "</div>";

        return $list;
    }

    function update_site_page($item)
    {
        $now = time();
        $clear_title = addslashes($item->title);
        $clear_content = addslashes($item->content);
        $query = "update mdl_site_pages 
                  set title='$clear_title', 
                  content='$clear_content', 
                  updated='$now' where id=$item->pageid";
        $this->db->query($query);
        $list = "Page updated successfully";
        return $list;
    }


}