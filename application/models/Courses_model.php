<?php

class Courses_model extends CI_Model
{


    /**
     * Courses_model constructor.
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
    public function get_course_preview($id, $class = 'odd')
    {
        $list = "";
        $idn = str_replace("/", "", $id);
        $query = "select * from mdl_course WHERE id=$idn";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $name = $row->fullname;
            $summary = substr($row->summary, 0, 75) . "....";
            $cost = $row->cost;
            $top = $row->top;
            $img_path = $row->img_path;
        }

        $courseurl = "https://" . $_SERVER['SERVER_NAME'] . "/index.php/courses/full/$idn";
        $iconurl = "https://" . $_SERVER['SERVER_NAME'] . "/assets/img/nopwd.svg";
        $list .= "<div class='courses category-browse category-browse-2' style='width: 96%;margin-top: 15px;margin-left: 2%;'>

                 <div class='coursebox clearfix $class first noinfobox'>
                    <div class='content'>
                        <div class='content-inner fileandcontent'>
                            <div class='course-content'>
                                <div class='course-heading'><h3 class='coursename'>
                                        <a href='$courseurl'>$name</a></h3>
                                    <div class='enrolmenticons'>
                                    <img class='smallicon' alt='Guest access' title='Guest access' src='$iconurl'>
                                    </div>
                                </div>
                                <div class='summary'>
                                    <div class='no-overflow'>
                                    <p>$summary</p></div>
                                </div>
                                <div class='course-readmore'><a class='btn btn-primary'  href='$courseurl'>Saiba Mais</a></div></div>
                             <div class='course-media'>
                             <a href='$courseurl'><img src='$img_path' width='292' height='173'></a></div>
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
    public function get_course_page($id)
    {
        $list = "";

        $idn = str_replace("/", "", $id);
        $query = "select * from mdl_course WHERE id=$idn";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $name = $row->fullname;
            $summary = $row->summary;
            $cost = $row->cost;
            $img_path = $row->img_path;
        }

        $class = 'odd';
        $courseurl = "https://" . $_SERVER['SERVER_NAME'] . "/index.php/register/preselect/$idn";
        $iconurl = "https://" . $_SERVER['SERVER_NAME'] . "/assets/img/nopwd.svg";
        $list .= "<div style='margin: auto;width: 96%;text-align: center; '><div class='courses category-browse category-browse-2' style='width: 96%;margin-top: 15px;margin-left: 2%;'>

                 <div class='coursebox clearfix $class first noinfobox'>
                    <div class='content'>
                        <div class='content-inner fileandcontent'>
                            <div class='course-content' style='text-align: justify;left: 37%;'>
                                <div class='course-heading'><h3 class='coursename'>$name</a></h3>
                                    <div class='enrolmenticons'>
                                    <img class='smallicon' alt='Guest access' title='Guest access' src='$iconurl'>
                                    </div>
                                </div>
                                <div class='summary'>
                                    <div class='no-overflow' style='margin-right:5%;'>
                                    <p style=''>$summary</p>
                                    <div class='course-heading'><h6 class='coursename'>Cost: $cost BRL</h6>
                                    <a class='btn btn-primary' style='margin-left: 15%;'  href='$courseurl'>Registo</a></div></div>
                                    </div>
                                </div>
                             <div class='course-media'><img src='$img_path' width='292' height='173'></div></div>
                     </div>
                   </div>
                 </div></div>";
        return $list;
    }

    public function get_category_items($catid)
    {
        $list = "";
        $query = "select * from mdl_course where category=$catid and cost>0";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $id = $row->id;
            $name = $row->fullname;
            $url = "https://" . $_SERVER['SERVER_NAME'] . "/index.php/courses/preview/$id";
            $list .= "<li class=''><a title='$name' class='' href='$url'>$name</a></li>";
        }
        return $list;
    }

    public function get_courses_menu_items()
    {
        $list = "";

        $list .= "<li class='dropdown mb2ctm-hover'><a href='#' class='sf-with-ul' data-toggle='' 
                title='Elements' >Cursos<span class='mobile-arrow'></span></a>";

        $list .= "<ul class='dropdown-list' style='display: block;' >";

        $query = "select * from mdl_course_categories order by name";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $courses = $this->get_category_items($row->id);
            $name = $row->name;
            $list .= "<li class='dropdown' ><a href='#' class='sf-with-ul' data-toggle='' 
                    title='$name' >$name<span class='mobile-arrow'></span></a>";
            $list .= "<ul class='dropdown-list' style='display: none;'>";
            $list .= $courses;
            $list .= "</ul></li>";
        } // end foreach

        $list .= "<li><a title=‘All’ href='https://learningindrops.com/index.php/courses/all' id=''>All Cursos</a></li>";

        $list .= "</ul></li>";
        return $list;
    }

    public function get_row_class($number)
    {
        if ($number & 1) {
            return 'odd';
        } // end if
        else {
            return 'even';
        } // end ese
    }


    public function get_all_courses_page()
    {
        $list = "";
        $query = "select * from mdl_course where category>0 and cost>0 order by category, fullname";
        $result = $this->db->query($query);
        $i = 1;
        foreach ($result->result() as $row) {
            $class = $this->get_row_class($i);
            $list .= $this->get_course_preview($row->id, $class);
            $i++;
        }
        return $list;
    }


}