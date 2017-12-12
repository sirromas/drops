<?php


class Index_model extends CI_Model
{

    /**
     * Index_model_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('courses_model');
    }

    /**
     * @return string
     */
    public function get_slider_section()
    {
        $list = "";
        $query = "select * from mdl_slides order by name";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $slides[$row->name] = $row->path;
        }

        $list .= "<div id='slider'>
                <aside id='block-region-slider' class='slider style-none block-region' data-blockregion='slider'
                       data-droptarget='1'>
                    <div id='inst19' class='block_mb2slider  block' role='complementary' data-block='mb2slider'
                         data-instanceid='19' aria-label='Mb2 Slider Block'>
                        <div class='content' id='yui_3_17_2_2_1510321856752_116'>
                            <div class='block_action notitle'></div>
        
        
                            <div id='myCarousel' class='carousel slide' data-ride='carousel' style='text-align: center;'>
                 <div id='logo_drops' style='position: absolute;z-index:100;bottom:0;width: 95%; margin:auto;'><img usemap='#image-map' src='http://theberry.us/clientes/drops/assets/img/banner-layout.png'></div>                
                    
                                <ol class='carousel-indicators'>
                                    <li data-target='#myCarousel' data-slide-to='0' class='active'></li>
                                    <li data-target='#myCarousel' data-slide-to='1'></li>
                                    <li data-target='#myCarousel' data-slide-to='2'></li>
                                </ol>
        
        
                                <div class='carousel-inner'>
                                    
                                    <div class='item'>
                                        <img class='mb2slider-slide-img'
                                             src='" . $slides['Slide2'] . "'
                                             alt='Slide2' style='z-index:0;max-width:100%;' id='slide2'>
                                    </div>
        
                                    <div class='item'>
                                        <img class='mb2slider-slide-img'
                                             src='" . $slides['Slide3'] . "'
                                             alt='Slide3' style='z-index:0;max-width:100%;' id='slide3'>
                                    </div>
        
                                    <div class='item active'>
                                        <img class='mb2slider-slide-img'
                                             src='" . $slides['Slide1'] . "'
                                             alt='Slide1' style='max-width:100%;'  id='slide1'>
                                    </div>
                                       
                                       
                                       
                                 </div>
                                        
                                <a class='left carousel-control' href='#myCarousel' data-slide='prev'>
                                    <span class='glyphicon glyphicon-chevron-left'></span>
                                    <span class='sr-only'>Previous</span>
                                </a>
                                <a class='right carousel-control' href='#myCarousel' data-slide='next'>
                                    <span class='glyphicon glyphicon-chevron-right'></span>
                                    <span class='sr-only'>Next</span>
                                </a>
                            </div>
                            
                            
                        </div>
                    </div>
                </aside>
        </div>";

        return $list;
    }

    /**
     * @return array
     */
    public function get_news_section()
    {
        $list = "";


        $query = "select * from mdl_news order by added limit 0,4";
        $result = $this->db->query($query);
        $i = 1;
        foreach ($result->result() as $row) {
            $title = $row->title;
            $id = $row->id;
            $url = "http://" . $_SERVER['SERVER_NAME'] . "/clientes/drops/index.php/news/show/$id";
            $list .= "<div class='theme-box'>
                             <a href='$url'>
                                   <div class='' style='position: relative;padding: 65px 10px;width:230px;height:180px;overflow: hidden;text-align: center;'>
                                      <h4>$title</h4>
                                      <div class='theme-boximg-color' style='background-color:#e63946;width:230px;height:180px;'></div>
                                      </div>
                              </a></div>";
            $i++;
        } // end foreach
        return $list;
    }

    /**
     * @return bool|string
     */
    public function get_about_section()
    {
        $list = "";
        $query = "select * from mdl_site_pages where id=1";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $preface = substr($row->content, 0, 375);
        }
        $url = 'http://' . $_SERVER['SERVER_NAME'] . '/clientes/drops/index.php/about/show';
        $list .= "
                <div class='theme-title title-left title-n style-1'style='margin:0 0 30px 0;' id=''>
                <h4 class='title'><span>Quem somos nós?</span></h4></div>
                <p id='yui_3_17_2_2_1510781966338_114'>$preface</p>
                <a href='$url'  class='btn btn-primary btn-lg btn-icon-before' style='margin:20px 0 0 0'><span class='btn-text'>Saiba Mais</span></a>
                ";
        return $list;
    }

    /**
     * @return mixed
     */
    public function get_announcements_block()
    {
        $query = "select * from mdl_site_pages where id=5";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $ann = $row->content;
        }
        return $ann;
    }

    /**
     *
     */
    public function create_courses_data()
    {
        $query = "select * from mdl_course where category>0 order by fullname";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $courses[] = mb_convert_encoding($row->fullname, 'UTF-8');
        }
        $path = $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/tmp/courses.json';
        file_put_contents($path, json_encode($courses));
    }

    /**
     * @param $item
     * @return string
     */
    public function get_search_results($item)
    {
        $list = "";
        $clear_item = urldecode($item);
        $query = "select * from mdl_course where fullname like '%$clear_item%'";
        $result = $this->db->query($query);
        $num = $result->num_rows();
        if ($num > 0) {
            foreach ($result->result() as $row) {
                $list .= $this->courses_model->get_course_preview($row->id);
            }
        } // end if $num>0
        else {
            $list .= "<br><div style='margin: auto;width:85%;' id='contact_form_container'>";
            $list .= "<div class='panel panel-default'>";
            $list .= "<div class='panel-heading' style='padding-left: 15px;font-weight: bold;background-color: #f5f5f5;border-color: #ddd; '>Search Results</div>";
            $list .= "<div class='panel-body'>";
            $list .= "<div class='row' style='text-align: center;font-weight: bold;'>";
            $list .= "<span class='col-md-12'> Nothing is found :)</span>";
            $list .= "</div>";
            $list .= "</div>";
            $list .= "</div>";
            $list .= "</div>";
        }
        return $list;
    }

    /**
     * @param $email
     * @return string
     */
    function get_subs_modal_dialog($email)
    {
        $list = "";

        $list .= "<div id='myModal' class='modal fade' role='dialog'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>New Subscriber</h4>
              </div>
              <div class='modal-body' style=''>
              <div class='row'>
              <span class='col-md-4'>Can we ask you some more info?</span> 
              </div> 
              <div class='row'>
              <span class='col-md-1'>Name* </span><span class='col-md-2'><input type='text' id='subs_name' placeholder='Your Name'></span>
              </div>
              
              <div class='modal-body' style=''>
              <div class='row'>
              <span class='col-md-1'>Email*</span><span class='col-md-2'><input type='text' id='subs_email' value='$email' placeholder='Your Email' ></span>
              </div>
              
              </div>
              <div class='modal-footer' style='text-align: center;'>
                <button type='button' class='btn btn-primary' id='add_new_subscriber'>Make Me Subscriber!</button>
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
    public function add_subscriber($item)
    {
        $data = json_decode($item);
        $now = time();
        $query = "insert into mdl_subscribers (name,email,status,added) 
                values ('$data->name','$data->email','1','$now')";
        $this->db->query($query);
    }

    /**
     * @return string
     */
    public function get_map_data()
    {
        $list = "";
        // http://theberry.us/clientes/drops/index.php/courses/full/3
        $i = 0;
        $courses = array();
        $query = "select * from mdl_course where top=1 order by fullname";
        $result = $this->db->query($query);
        $num = $result->num_rows();
        if ($num > 0) {
            foreach ($result->result() as $row) {
                $item = new stdClass();
                $item->id = $row->id;
                $item->name = $row->fullname;
                $item->link = "http://" . $_SERVER['SERVER_NAME'] . "/clientes/drops/index.php/courses/full/$row->id";
                $courses[$i] = $item;
                $i++;
            }

            $link1 = $courses[0]->link;
            $link2 = $courses[1]->link;
            $link3 = $courses[2]->link;
            $link4 = $courses[3]->link;
            $link5 = $courses[4]->link;

            $name1 = $courses[0]->name;
            $name2 = $courses[1]->name;
            $name3 = $courses[2]->name;
            $name4 = $courses[3]->name;
            $name5 = $courses[4]->name;


            $list .= "<map name='image-map'>
            <area  alt='$link1' title='$name1' href='$link1' coords='0,196,144,327'    shape='rect'>
            <area  alt='$link2' title='$name2' href='$link2' coords='98,51,235,190'    shape='rect'>
            <area  alt='$link3' title='$name3' href='$link3' coords='400,161,260,0'   shape='rect'>
            <area  alt='$link4' title='$name4' href='$link4' coords='547,189,417,63'  shape='rect'>
            <area  alt='$link5' title='$name5' href='$link5' coords='517,317,647,200'  shape='rect'>
            </map>";
        } // end if $num>0
        return $list;
    }


}