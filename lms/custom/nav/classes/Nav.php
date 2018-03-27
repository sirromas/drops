<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lms/custom/utils/classes/Utils.php';

class Nav extends Utils
{

    /**
     * Nav constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
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
                case 3:
                    $list .= $this->get_teacher_menu();
                    break;
                case 4:
                    $list .= $this->get_teacher_menu();
                    break;
                case 5:
                    $list .= $this->get_student_menu();
                    break;
                case 11:
                    $list .= $this->get_manager_menu();
                    break;
            }
        } // end if $userid>0
        return $list;
    }

    /**
     *
     */
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
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Site Pages'>Páginas do Site<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";

        $query = "select * from mdl_site_pages order by title";
        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $title = $row['title'];
            $list .= "<li class=''><a id='page_$id' title='$title' href='#' onclick='return false;'>$title</a></li>";
        }

        $list .= "<li class=''><a id='page_contact' title='Página de Contato' class='' href='#' onclick='return false;'>Página de Contato</a></li>";
        $list .= "<li class=''><a id='page_news' title='News' class='' href='#' onclick='return false;'>News</a></li>";
        $list .= "<li class=''><a id='page_slider' title='Banner Sliders' class='' href='#' onclick='return false;'>Banner Sliders</a></li>";

        $list .= "</ul>";
        $list .= "</li>";

        return $list;
    }

    /**
     * @return string
     */
    function get_admin_menu()
    {
        $list = "";
        $pages = $this->get_site_pages();

        $list .= "<li class='dropdown'>";
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Tools'>Ferramentas<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";

        $list .= "<li class=''><a id='contacts' title='Contacts' class='' href='#' onclick='return false;'>Feedback dos Usuários</a></li>";
        $list .= "<li class=''><a id='courses' title='Courses' class='' href='#' onclick='return false;'>Cursos</a></li>";
        $list .= "<li class=''><a id='subscribers' title='Subscribers' class='' href='#' onclick='return false;'>Inscrições</a></li>";
        $list .= "<li class=''><a id='promotion' title='Send Promotion News Letter' class='' href='#' onclick='return false;'>Promotion Letter</a></li>";

        $list .= "</ul>";
        $list .= "</li>";

        $list .= "<li class='dropdown'>";
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Users'>Usuários<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";

        $list .= "<li class=''><a id='managers' title='Managers' class='' href='#' onclick='return false;'>Administradores</a></li>";
        $list .= "<li class=''><a id='partners' title='Partners' class='' href='#' onclick='return false;'>Parceiros</a></li>";
        $list .= "<li class=''><a id='teachers'  title='Teachers' class='' href='#' onclick='return false;'>Professores</a></li>";
        $list .= "<li class=''><a id='students' title='Students' class='' href='#' onclick='return false;'>Alunos</a></li>";
        $list .= "<li class=''><a id='add_manager' title='Add Manager' class='' href='#' onclick='return false;'>Adicionar Administrador</a></li>";

        $list .= "</ul>";
        $list .= "</li>";

        $list .= $pages;

        /*
        $list .= "<li class='dropdown'>";
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Reports'>Relatórios<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";

        $list .= "<li class=''><a id='revenue_rep' title='' class='Revenue Report' href='#' onclick='return false;'>Revenue report</a></li>";
        $list .= "<li class=''><a id='cstm_report1' title='Custom Report #1' class='' href='#' onclick='return false;'>Custom report #1</a></li>";
        $list .= "<li class=''><a id='cstm_report1' title='Custom Report #2' class='' href='#' onclick='return false;'>Custom report #2</a></li>";

        $list .= "</ul>";
        $list .= "</li>";
        */

        $list .= "<li class=''><a id='revenue_rep' title='Denúncia' class='' href='#' onclick='return false;'>Denúncia</a></li>";


        return $list;
    }


    /**
     * @return string
     */
    function get_manager_menu()
    {
        $list = "";
        $userid=$this->user->id;
        $list .= "<li class='dropdown'>";
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Courses'>Courses<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";

        $list .= "<li class=''><a id='my_courses'  data-userid='$userid' title='My Courses'     href='#' onclick='return false;'>My Courses</a></li>";
        $list .= "<li class=''><a id='add_course'  data-userid='$userid' title='Add New Course' href='#' onclick='return false;'>Add New Course</a></li>";

        $list .= "</ul>";
        $list .= "</li>";

        $list .= "<li class='dropdown'>";
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Users'>Users<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";

        $list .= "<li class=''><a id='m_students' data-userid='$userid' title='Students'  href='#' onclick='return false;'>Students</a></li>";
        $list .= "<li class=''><a id='m_teachers' data-userid='$userid' title='Teachers'  href='#' onclick='return false;'>Teachers</a></li>";
        $list .= "<li class=''><a id='add_user'   data-userid='$userid' title='Add User'  href='#' onclick='return false;'>Add User</a></li>";

        $list .= "</ul>";
        $list .= "</li>";

        $list .= "<li class='dropdown'>";
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Feedback'>Feedback<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";


        $list .= "<li class=''><a id='m_suggest_content' data-userid='$userid' title='Students Content Suggest'  href='#' onclick='return false;'>Students Content </a></li>";
        $list .= "<li class=''><a id='m_feedback' data-userid='$userid' title='Students Proposals'  href='#' onclick='return false;'>Students Proposals</a></li>";
        $list .= "<li class=''><a id='m_suggest_teacher'   data-userid='$userid' title='Students Teachers Suggest'  href='#' onclick='return false;'>Students Teachers </a></li>";

        $list .= "</ul>";
        $list .= "</li>";

        $list .= "<li class=''><a id='m_revenue'   data-userid='$userid' title='Revenue Report'  href='#' onclick='return false;'>Revenue report</a></li>";

        return $list;
    }

    /**
     * @return string
     */
    function get_teacher_menu()
    {
        $list = "";

        return $list;
    }

    /**
     * @return string
     */
    function get_student_menu()
    {
        $list = "";
        $link = 'https://' . $_SERVER['SERVER_NAME'] . '/lms/my/';

        $list .= "<li><a  href='$link'>Courses</a></li>";

        $list .= "<li class='dropdown'>";
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Subscription'>Subscription<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";
        $list .= "<li><a id='st_courses' href='#' onclick='return false;'>Subscribe</a></li>";
        $list .= "<li><a id='st_subscription' href='#' onclick='return false;'>My subscriptions</a></li>";
        $list .= "</ul>";
        $list .= "</li>";

        $list .= "<li class='dropdown'>";
        $list .= "<a href='#' class='sf-with-ul' data-toggle='' title='Feedback'>Feedback<span class='mobile-arrow'></span></a>";
        $list .= "<ul class='dropdown-list' style='display: none;'>";
        $list .= "<li class=''><a id='st_content'   title='Suggest Content' class='' href='#' onclick='return false;'>Suggest Content</a></li>";
        $list .= "<li class=''><a id='st_teacher'   title='Suggest Teacher' class='' href='#' onclick='return false;'>Suggest Teacher</a></li>";
        $list .= "<li class=''><a id='st_proposals' title='Send Proposal'   class='' href='#' onclick='return false;'>Send Proposal</a></li>";
        $list .= "<li class=''><a id='st_feedback'  title='Send Feedback'   class='' href='#' onclick='return false;'>Send Feedback</a></li>";
        $list .= "</ul>";
        $list .= "</li>";

        $list .= "<li><a id='st_resume' href='#' onclick='return false;'>Attach Resume</a></li>";
	    $list.="<li class='nav navbar-nav navbar-left' style='margin-top:3px;'><div class='theme-searchform'><input id='theme-coursesearchbox' style='' type='text' value='' placeholder='Pesquisar Cursos' name='search'><button type='submit' id='index_search'><i class='fa fa-search' id='index_search'></i></button></div></li>";

        return $list;
    }


}