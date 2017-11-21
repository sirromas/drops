<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/utils/classes/Utils.php';

class Slider extends Utils
{

    function __construct()
    {
        parent::__construct();
    }

    function get_ops_items($id)
    {
        $list = "";
        $list .= "<span>";
        $list .= "<i id='slide_upload_$id' title='Upload Slide' style='cursor: pointer;' class='fa fa-pencil-square-o' aria-hidden='true'></i>";
        $list .= "</span>";
        return $list;
    }

    function get_sliders_list()
    {
        $list = "";

        $list .= "<div class='row'>";
        $list .= "<span class='span12'>";

        $list .= "<table id='banners_table' class='display' cellspacing='0' width='100%'>";
        $list .= "<thead>";
        $list .= "<tr>";
        $list .= "<th>Slide#</th>";
        $list .= "<th>Path</th>";
        $list .= "<th>Added</th>";
        $list .= "<th>Ops</th>";
        $list .= "</tr>";
        $list .= "</thead>";
        $list .= "<tbody>";
        $query = "select * from mdl_slides order by name";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $name = $row['name'];
            $path = $row['path'];
            $added = date('m-d-Y', $row['added']);
            $ops = $this->get_ops_items($id);
            $list .= "<tr>";
            $list .= "<td>$name</td>";
            $list .= "<td><a href='$path' target='_blank'>$path</a></td>";
            $list .= "<td>$added</td>";
            $list .= "<td>$ops</td>";
            $list .= "</tr>";
        }
        $list .= "</tbody>";
        $list .= "</table>";

        $list .= "</span>";
        $list .= "</div>";

        return $list;
    }

    function get_slide_upload_dialog($id)
    {
        $list = "";
        $list .= "<div id='myModal' class='modal fade' role='dialog'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>Upload Slide</h4>
              </div>
              <div class='modal-body'>
                <input type='hidden' id='slide_id' value='$id'>
                <div class='row' style='text-align: center;margin-left: 25px; '>
                <input type='file' id='files' accept='image/gif, image/jpeg, image/png'>
                </div>
                
                <div class='row'  id='loader' style='margin-top:10px;margin-bottom: 10px;display: none;'>
                <span class='span12'><img src='/clientes/drops/assets/img/ajax_loader.gif'></span>
                </div>
                
                <div class='row' >
                <span class='span12' id='slide_err' style='color: red;width: 885px;margin-left: 15px;'></span>
                </div>
                
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-primary' id='upload_slide_done'>Upload</button>
                <button type='button' class='btn btn-primary' id='slider_cancel_dialog'>Cancel</button>
              </div>
            </div>
          </div>
        </div>";
        return $list;
    }

    function upload_slide($file, $post)
    {
        $id = $post['id'];
        $added = time();
        $tmp_name = $file['tmp_name'];
        $error = $file['error'];
        $size = $file['size'];
        if ($error == 0 && $size > 0) {
            $path = time() . ".jpg";
            $dest = $_SERVER["DOCUMENT_ROOT"] . "/clientes/drops/assets/img/$path";
            $ui_path = "http://" . $_SERVER['SERVER_NAME'] . "/clientes/drops/assets/img/$path";
            $status = move_uploaded_file($tmp_name, $dest);
            if ($status) {
                $query = "update mdl_slides set path='$ui_path', added='$added' where id=$id";
                $this->db->query($query);
            } // end if ststus
        } // end if $error==0 && $size>0
    }
}