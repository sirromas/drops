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
     * @param $path
     * @return string
     */
    function get_news_tumb_block($path)
    {
        $list = "";
        $src = "http://" . $_SERVER['SERVER_NAME'] . "/clientes/drops/lms/custom/news/assets/$path";
        $list .= "<img src='$src' width='100' height='30'>";
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
        $list .= "<th>Thumb</th>";
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
                $img = $this->get_news_tumb_block($row['pic_path']);
                $added = date('m-d-Y', $row['added']);
                $ops = $this->get_ops_items($id);
                $list .= "<tr>";
                $list .= "<td>$title</td>";
                $list .= "<td>$img</td>";
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
     * @param int $selected
     * @return string
     */
    function get_chars_limit_box($selected = 0)
    {
        $list = "";
        $list .= "<select id='climit'>";
        for ($i = 0; $i < 1024; $i++) {
            if ($i == $selected) {
                $list .= "<option value='$i' selected>$i</option>";
            } // end if
            else {
                $list .= "<option value='$i'>$i</option>";
            } // end else
        } // end for
        $list .= "</select>";
        return $list;
    }

    /**
     * @return string
     */
    function get_add_news_modal_dialog()
    {
        $list = "";
        $limitbox = $this->get_chars_limit_box();
        $list .= "<div id='myModal' class='modal fade' role='dialog'>
          <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>Add News</h4>
              </div>
              <div class='modal-body'>
                
                <div class='row' style='margin-bottom:10px;text-align: center;'>
                <span class='col-md-9'><input type='text' id='news_title' style='width: 885px;' placeholder='News Title'></span>
                <span class='col-md-2'>Length (chars)*</span><span class='col-md-1'>$limitbox</span>
                </div>
                
                <div class='row' style='margin-bottom:10px;text-align: center;'>
                <span class='col-md-2'>News Image* </span><span class='col-md-6'><input type='file' id='files'></span><span class='col-md-4'><input type='checkbox' id='active' checked> &nbsp; Active</span>
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
            $status = $row['active'];
            $limit=$row['chars_limit'];
        }

        $list = "";
        $checked = ($status == 1) ? 'checked' : '';
        $limitbox=$this->get_chars_limit_box($limit);
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
                <span class='col-md-9'><input type='text' id='news_title' value='$title' style='width: 100%;'></span>
                <span class='col-md-2'>Length (chars)*</span><span class='col-md-1'>$limitbox</span>
                </div>
                
                <div class='row' style='margin-bottom:10px;text-align: center;'>
                <span class='col-md-2'>News Image </span><span class='col-md-6'><input type='file' id='files'></span><span class='col-md-4'><input type='checkbox' id='active' $checked> &nbsp; Active</span>
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
    function add_news($file, $post)
    {
        /*
        echo "<pre>";
        print_r($file);
        echo "</pre><br>";

        echo "<pre>";
        print_r($post);
        echo "</pre><br>";
        */


        $file_data = $file[0];
        if ($file_data['error'] == 0 && $file_data['size'] > 0) {
            $tmp_filename = $file_data['tmp_name'];
            $filename = time() . '.jpg';
            $destination = $_SERVER['DOCUMENT_ROOT'] . "/clientes/drops/lms/custom/news/assets/$filename";
            $status = move_uploaded_file($tmp_filename, $destination);
            if ($status) {
                $clear_title = addslashes(htmlentities($post['title'])) ;
                $clear_conent = addslashes($post['content']);
                $item_status = $post['status'];
                $now = time();
                $limit=$post['limit'];
                $query = "insert into mdl_news (title,content,added, active, pic_path, chars_limit) 
                  values ('$clear_title','$clear_conent','$now', $item_status, '$filename', $limit)";
                $this->db->query($query);
            }  // end if $status
        } // end if $file_data['error']==0 && $file_data['size']>0
    }


    /**
     * @param $item
     */
    function update_news_item($file, $post)
    {

        $id = $post['id'];
        $title = $post['title'];
        $content = $post['content'];
        $status = $post['status'];
        $limit=$post['limit'];

        $clear_title = addslashes(htmlentities($title));
        $clear_conent = addslashes($content);
        $now = time();
        $query = "update mdl_news 
                  set title='$clear_title', 
                  content='$clear_conent', 
                  active=$status, chars_limit=$limit,
                  added='$now'
                  where id=$id";
        $this->db->query($query);

        if (isset($file)>0) {
            $file_data = $file[0];
            if ($file_data['error'] == 0 && $file_data['size'] > 0) {
                $tmp_filename = $file_data['tmp_name'];
                $filename = time() . '.jpg';
                $destination = $_SERVER['DOCUMENT_ROOT'] . "/clientes/drops/lms/custom/news/assets/$filename";
                $status = move_uploaded_file($tmp_filename, $destination);
                if ($status) {
                    $query = "update mdl_news set pic_path='$filename' where id=$id";
                    $this->db->query($query);
                }
            } // end if $file_data['error'] == 0 && $file_data['size'] > 0
        }
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