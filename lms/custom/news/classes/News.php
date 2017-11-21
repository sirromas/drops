<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/utils/classes/Utils.php';

class News extends Utils
{
    /**
     * News constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $id
     * @return string
     */
    function get_ops_items($id)
    {
        $list = "";
        $list .= "<span >";
        $list .= "<i id='news_edit_$id' style='cursor: pointer;' class='fa fa-pencil-square-o' aria-hidden='true'></i>";
        $list .= "</span>&nbsp;&nbsp;&nbsp;";
        $list .= "<span >";
        $list .= "<i id='news_del_$id' style='cursor: pointer;' class='fa fa-times' aria-hidden='true'></i>";
        $list .= "</span>&nbsp;";
        return $list;
    }

    /**
     * @return string
     */
    function get_news_list()
    {
        $list = "";

        $list .= "<div class='row' style='margin-bottom: 15px;'>";
        $list .= "<span class='span3'><button id='add_news' class='btn btn-primary'>Add</button></span>";
        $list .= "</div>";

        $list .= "<div class='row'>";
        $list .= "<table id='news_table' class='display' cellspacing='0' width='100%'>";
        $list .= "<thead>";
        $list .= "<tr>";
        $list .= "<th>Title</th>";
        $list .= "<th>Content</th>";
        $list .= "<th>Date Added</th>";
        $list .= "<th>Ops</th>";
        $list .= "</tr>";
        $list .= "</thead>";

        $list .= "<tbody>";
        $query = "select * from mdl_news order by added desc";
        $num = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $title = $row['title'];
                $content = substr($row['content'], 0, 75);
                $added = date('m-d-Y', $row['added']);
                $ops = $this->get_ops_items($id);
                $list .= "<tr>";
                $list .= "<td>$title</td>";
                $list .= "<td>$content</td>";
                $list .= "<td>$added</td>";
                $list .= "<td>$ops</td>";
                $list .= "</tr>";
            } // end while
        } // end if $num > 0
        $list .= "</tbody>";

        $list .= "</table>";
        $list .= "</div>";
        return $list;
    }

    /**
     * @return string
     */
    function get_add_news_modal_dialog()
    {
        $list = "";
        $list .= "<div id='myModal' class='modal fade' role='dialog'>
          <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>Add News</h4>
              </div>
              <div class='modal-body'>
                
                <div class='row' style='margin-bottom:10px;text-align: center;'>
                <span class='span12'><input type='text' id='news_title' style='width: 885px;' placeholder='News Title'></span>
                </div>
                
                <div class='row' style='margin-bottom: 10px;'>
                <textarea id='news_content' placeholder='News Content'></textarea>
                <script>
                CKEDITOR.replace( 'news_content');
                </script>
                </div>
                
                <div class='row' >
                <span class='span12' id='news_err' style='color: red;width: 885px;margin-left: 15px;'></span>
                </div>
                
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-primary' id='add_news_done'>Add</button>
                <button type='button' class='btn btn-primary' id='news_cancel_dialog'>Cancel</button>
              </div>
            </div>
          </div>
        </div>";
        return $list;
    }

    /**
     * @param $id
     * @return string
     */
    function get_edit_news_dialog($id)
    {
        $query = "select * from mdl_news where id=$id";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $title = $row['title'];
            $content = $row['content'];
        }

        $list = "";
        $list .= "<div id='myModal' class='modal fade' role='dialog'>
          <div class='modal-dialog modal-lg'>
           <input type='hidden' id='news_id' value='$id'>
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>Edit News</h4>
              </div>
              <div class='modal-body'>
                
                <div class='row' style='margin-bottom:10px;text-align: center;'>
                <span class='span12'><input type='text' value='$title' id='news_title' style='width: 885px;' placeholder='News Title'></span>
                </div>
                
                <div class='row' style='margin-bottom: 10px;'>
                <textarea id='news_content' placeholder='News Content'>$content</textarea>
                <script>
                CKEDITOR.replace( 'news_content');
                </script>
                </div>
                
                <div class='row'>
                <span class='span12' id='news_err' style='color: red;width: 885px;margin-left: 15px;'></span>
                </div>
                
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-primary' id='news_update_done'>Update</button>
                <button type='button' class='btn btn-primary' id='news_cancel_dialog'>Cancel</button>
              </div>
            </div>
          </div>
        </div>";
        return $list;
    }

    /**
     * @param $item
     */
    function add_news($item)
    {
        $clear_title = addslashes($item->title);
        $clear_conent = addslashes($item->content);
        $now = time();
        $query = "insert into mdl_news (title,content,added) 
                  values ('$clear_title','$clear_conent','$now')";
        $this->db->query($query);
    }


    /**
     * @param $item
     */
    function update_news_item($item)
    {
        $clear_title = addslashes($item->title);
        $clear_conent = addslashes($item->content);
        $now = time();
        $query = "update mdl_news 
                  set title='$clear_title', 
                  content='$clear_conent', 
                  added='$now' 
                  where id=$item->id";
        $this->db->query($query);
    }

    /**
     * @param $id
     */
    function delete_news_item($id)
    {
        $query = "delete from mdl_news where id=$id";
        $this->db->query($query);
    }


}