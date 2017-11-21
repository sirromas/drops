<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/utils/classes/Utils.php';

class Nav extends Utils
{

    /**
     * Nav constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    function get_menu()
    {
        $list = "";
        $userid = $this->user->id;
        if ($userid > 0) {
            $roleid = $this->get_user_role($userid);
            switch ($roleid) {
                case 0:
                    $list .= $this->get_admin_menu();
                    break;
                case 1:
                    $list .= $this->get_admin_menu();
                    break;
                case 4:
                    $list .= $this->get_teacher_menu();
                    break;
                case 5:
                    $list .= $this->get_student_menu();
                    break;
                case 9:
                    $list .= $this->get_manager_menu();
                    break;
            }
        } // end if $userid>0
        return $list;
    }

    function get_admin_courses()
    {
        $query = "select * from mdl_course where id>1 order by fullname";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        }
    }

    /**
     * @return string
     */
    function get_site_pages()
    {
        $list = "";

        $list .= "<li class='dropdown'>";
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Site Pages'>Site Pages<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";

        $query = "select * from mdl_site_pages order by title";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $title = $row['title'];
            $list .= "<li class=''><a id='page_$id' title='$title' href='#' onclick='return false;'>$title</a></li>";
        }

        $list .= "<li class=''><a id='page_contact' title='Contact Page' class='' href='#' onclick='return false;'>Contact Page</a></li>";
        $list .= "<li class=''><a id='page_news' title='News' class='' href='#' onclick='return false;'>News</a></li>";
        $list .= "<li class=''><a id='page_slider' title='Banner Sliders' class='' href='#' onclick='return false;'>Banner Sliders</a></li>";

        $list .= "</ul>";
        $list .= "</li>";

        return $list;
    }

    function get_admin_menu()
    {
        $list = "";
        $courses = $this->get_admin_courses();
        $pages = $this->get_site_pages();

        $list .= "<li class='dropdown'>";
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Tools'>Tools<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";

        $list .= "<li class=''><a id='contacts' title='Contacts' class='' href='#' onclick='return false;'>Users Feedback</a></li>";
        $list .= "<li class=''><a id='courses' title='Courses' class='' href='#' onclick='return false;'>Courses</a></li>";
        $list .= "<li class=''><a id='subscribers' title='Subscribers' class='' href='#' onclick='return false;'>Subscribers</a></li>";

        $list .= "</ul>";
        $list .= "</li>";

        $list .= "<li class='dropdown'>";
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Users'>Users<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";

        $list .= "<li class=''><a id='managers' title='Managers' class='' href='#' onclick='return false;'>Managers</a></li>";
        $list .= "<li class=''><a id='partners' title='Partners' class='' href='#' onclick='return false;'>Partners</a></li>";
        $list .= "<li class=''><a id='teachers'  title='Teachers' class='' href='#' onclick='return false;'>Teachers</a></li>";
        $list .= "<li class=''><a id='students' title='Students' class='' href='#' onclick='return false;'>Students</a></li>";

        $list .= "</ul>";
        $list .= "</li>";

        $list .= $pages;

        $list .= "<li class='dropdown'>";
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Reports'>Reports<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";

        $list .= "<li class=''><a id='revenue_rep' title='' class='Revenue Report' href='#' onclick='return false;'>Revenue report</a></li>";
        $list .= "<li class=''><a id='cstm_report1' title='Custom Report #1' class='' href='#' onclick='return false;'>Custom report #1</a></li>";
        $list .= "<li class=''><a id='cstm_report1' title='Custom Report #2' class='' href='#' onclick='return false;'>Custom report #2</a></li>";

        $list .= "</ul>";
        $list .= "</li>";

        return $list;
    }


    function get_manager_menu()
    {
        $list = "";

        return $list;
    }

    function get_teacher_menu()
    {
        $list = "";

        return $list;
    }

    function get_student_menu()
    {
        $list = "";

        return $list;
    }


}