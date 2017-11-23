<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/utils/classes/Utils.php';

class Subscribers extends Utils
{

    /**
     * Subscribers constructor.
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
        $list .= "<span >&nbsp;&nbsp;&nbsp;";
        $list .= "<i id='subs_edit_$id' style='cursor: pointer;' class='fa fa-pencil-square-o' aria-hidden='true'></i>";
        $list .= "</span>&nbsp;&nbsp;&nbsp;";
        return $list;
    }

    /**
     * @return string
     */
    function get_subsribers_page()
    {
        $list = "";

        $list .= "<table id='subs_table' class='display' cellspacing='0' width='100%'>";
        $list .= "<thead>";
        $list .= "<tr>";
        $list .= "<th>Name</th>";
        $list .= "<th>Email</th>";
        $list .= "<th style='text-align: center;'>Active</th>";
        $list .= "<th style='text-align: center;'>Subscription Date</th>";
        $list .= "<th>Ops</th>";
        $list .= "</tr>";
        $list .= "</thead>";
        $list .= "<tbody>";
        $query = "select * from mdl_subscribers order by added desc";
        $num = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $name = $row['name'];
                $email = $row['email'];
                $status = ($row['status'] == 1) ? 'Yes' : 'No';
                $ops = $this->get_ops_items($id);
                $date = date('m-d-Y', $row['added']);
                $list .= "<tr>";
                $list .= "<td>$name</td>";
                $list .= "<td>$email</td>";
                $list .= "<td style='text-align: center;'>$status</td>";
                $list .= "<td style='text-align: center;'>$date</td>";
                $list .= "<td>$ops</td>";
                $list .= "</tr>";
            }
        } // end if $num
        $list .= "</tbody>";
        $list .= "</table>";
        return $list;
    }

    /**
     * @param $id
     * @return mixed
     */
    function get_subscriber_status($id)
    {
        $query = "select * from mdl_subscribers where id=$id";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $status = $row['status'];
        }
        return $status;
    }

    /**
     * @param $id
     * @return string
     */
    function get_radio_block($id)
    {
        $list = "";

        $status = $this->get_subscriber_status($id);
        if ($status == 1) {
            $chkA = "<input type='radio' class='status' name='status' value='1' checked> Yes";
            $chkB = "<input type='radio' class='status' name='status' value='0'   > No";
        } // end if
        else {
            $chkA = "<input type='radio' class='status' name='status' value='1'> Yes";
            $chkB = "<input type='radio' class='status' name='status' value='0' checked> No";
        }

        $list .= "<div class='row' style='margin-bottom:10px;padding-left: 15px; '>
                <span class='col-md-2'>Active: </span>
                <span class='col-md-2'>$chkA</span>
                <span class='col-md-2'>$chkB</span>
                </div>";
        return $list;
    }

    /**
     * @param $id
     * @return string
     */
    function get_subs_dialog($id)
    {
        $list = "";
        $radio = $this->get_radio_block($id);
        $status = $this->get_subscriber_status($id);
        $list .= "<div id='myModal' class='modal fade' role='dialog'>
          <div class='modal-dialog'>
           <input type='hidden' id='subs_id' value='$id'>
           <input type='hidden' id='status' value='$status'>
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>Subscriber Status</h4>
              </div>
              <div class='modal-body' style=''>";
        $list .= $radio;
        $list .= "</div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-primary' id='subs_update_done'>Update</button>
                <button type='button' class='btn btn-primary' id='course_cancel_dialog'>Cancel</button>
              </div>
            </div>
          </div>
        </div>";
        return $list;
    }

    /**
     * @param $item
     */
    function update_subs($item)
    {
        $query = "update mdl_subscribers set status=$item->status where id=$item->id";
        $this->db->query($query);
    }

}