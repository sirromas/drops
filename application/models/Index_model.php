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
        $list   = "";
        $query  = "select * from mdl_slides order by name";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $slides[$row->name] = $row->path;
        }

        $list
            .= "<div id='slider'>
                <aside id='block-region-slider' class='slider style-none block-region' data-blockregion='slider'
                       data-droptarget='1'>
                    <div id='inst19' class='block_mb2slider  block' role='complementary' data-block='mb2slider'
                         data-instanceid='19' aria-label='Mb2 Slider Block'>
                        <div class='content' id='yui_3_17_2_2_1510321856752_116'>
                            <div class='block_action notitle'></div>
        
        
                            <div id='myCarousel' class='carousel slide' data-ride='carousel' style='text-align: center;'>
                 <div id='logo_drops' style='position: absolute;z-index:100;bottom:0;width: 95%; margin:auto;'><img usemap='#image-map' style='height: auto; width: auto;  max-height:175px; ' class='' src='https://learningindrops.com/assets/img/banner-layout1.png'></div>                
                    
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
     * @param $row
     *
     * @return string
     */
    public function get_news_item($row)
    {
        $list     = "";
        $title    = $row->title;
        $id       = $row->id;
        $pic_path = $row->pic_path;
        $limit    = $row->chars_limit;
        $url      = "https://" . $_SERVER['SERVER_NAME']
            . "/index.php/news/show/$id";
        $path     = "https://" . $_SERVER['SERVER_NAME']
            . "/lms/custom/news/assets/$pic_path";
        $content  = $row->content;
        $preface  = substr($content, 0, $limit) . ' ....';
        $list
                  .= "<a href='$url'>
                       <div class='row' style='margin-bottom: 15px;'>
                       <span class='col-md-12' style='font-weight: bold;text-align: center;'>$title</span>
                       </div>
                       <div class='row' style='text-align: center;'>
                       <span class='col-md-12'><img class='img-circle' width='300'  alt='$title' src='$path'></span>
                       </div>
                       <div class='row' style='text-align: justify;margin-top: 15px;'>
                       <span class='col-md-12' style='color: #4c4c4c;'>$preface</span>
                       </div>
                   </a>";

        return $list;
    }

    /**
     * @return array
     */
    public function get_news_section()
    {
        $list   = "";
        $url    = "https://" . $_SERVER['SERVER_NAME'] . "/index.php/news/all";
        $query
                = "select * from mdl_news where active=1 order by added desc limit 0,4";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $item = $this->get_news_item($row);
            $list .= "<div class='row' style='text-align: center;'>";
            $list .= "<span class='col-md-10'>$item</span>";
            $list .= "</div>";
        } // end foreach
        $list .= "<div class='row'>";
        $list .= "<span class='col-md-9'><a href='$url'  class='btn btn-primary btn-lg btn-icon-before' style='margin:20px 0 0 0'><span class='btn-text'>Veja todas as Notícias</span></a></span>";
        $list .= "</div>";

        return $list;
    }

    /**
     * @return bool|string
     */
    public function get_about_section()
    {
        $list   = "";
        $query  = "select * from mdl_site_pages where id=1";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $limit   = $row->chars_limit;
            $preface = substr($row->content, 0, $limit);
        }
        $url = 'https://' . $_SERVER['SERVER_NAME'] . '/index.php/about/show';
        $list
             .= "
                <div class='theme-title title-left title-n style-1'style='margin:0 0 30px 0;' id=''>
                <h4 class='title'><span>Quem somos nós?</span></h4></div>
                <p id='yui_3_17_2_2_1510781966338_114'>$preface</p>
                <a href='$url'  class='btn btn-primary btn-lg btn-icon-before' style='margin:20px 0 0 0'><span class='btn-text'>Saiba Mais</span></a>";

        return $list;
    }

    /**
     * @return mixed
     */
    public function get_announcements_block()
    {
        $query  = "select * from mdl_site_pages where id=5";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $ann = $row->content;
        }
        $suggest_block = $this->get_suggest_block();
        $data          = $ann . $suggest_block;

        return $data;
    }

    public function get_suggest_block()
    {
        $list = "";


        $list .= "<div class='row' style='margin-left: 15px;margin-top: 35px;margin-right: 15px;'>";
        $list .= "<span class='col-md-4'><a  data-trigger='hover' data-placement='top' href='#' onclick='return false;'  data-toggle='popover' title='TORNE-SE UM INSTRUTOR AMIGO' data-content='Este instrutor é uma pessoa interessada em colaborar com algum curso para troca de informações e aprimoramento de conhecimento da mesma forma que ocorre em fóruns de discussão sobre uma temática específica. Este instrutor pode ser remunerado ou não de acordo com cada coordenador/gerente de gota.'><img class='contact_suggest' title='TORNE-SE UM INSTRUTOR AMIGO' src='/assets/img/user-6.png' width='120px' height='120px' style='cursor: pointer;margin-left:9px;'><br><div class='contact_suggest'  title='TORNE-SE UM INSTRUTOR AMIGO' style='text-align: center;margin-top: 10px;'>TORNE-SE UM INSTRUTOR AMIGO</div></a></span>";
        $list .= "<span class='col-md-4'><a  data-trigger='hover' data-placement='top' href='#' onclick='return false;'  data-toggle='popover' title='TORNE-SE UM USUÁRIO APRENDIZ' data-content='Estes seriam usuários de gotas que desejam criar os seus cursos, contribuindopara a gota com envio periódico de sugestões e informações. Ele não éremunerado, ganhando com a troca de informações e acesso a informações privilegiadas de acordo com a anuência de cada coordenador/gerente de gota.'><img class='contact_suggest' title='TORNE-SE UM USUÁRIO APRENDIZ' src='/assets/img/user-4.png' width='120px' height='120px' style='cursor: pointer;margin-left:10px;'><br><div class='contact_suggest' title='TORNE-SE UM USUÁRIO APRENDIZ' style='text-align: center;margin-top: 10px;'>TORNE-SE UM USUÁRIO APRENDIZ</div></a></span>";
        $list .= "<span class='col-md-4'><a  data-trigger='hover' data-placement='top' href='#' onclick='return false;'  data-toggle='popover' title='ANUNCIE CONOSCO' data-content=' Amplie seus negócios anunciando no nosso portal. Nossos usuários podem conhecer melhor seus produtos e serviços. Divulgue conosco seus cursos de graduação, pós-graduação, tutoriais e ferramentas de educação.'><img class='contact_suggest2' title='ANUNCIE CONOSCO'  src='/assets/img/megaphone-1.png' width='120px' height='120px' style='cursor: pointer;margin-left:18px;'><br><div class='contact_suggest2' title='ANUNCIE CONOSCO' style='text-align: center;margin-top: 10px;'>ANUNCIE CONOSCO</div></a></span>";
        $list .= "</div>";


        /*
        $list.="<div class='row' style='margin-left: 15px;margin-top: 35px;margin-right: 15px;text-align: center;'>";
        $list.="<span class='col-md-9'><a  data-trigger='hover' data-placement='top' href='#' onclick='return false;' data-toggle='popover' title='TORNE-SE UM INSTRUTOR AMIGO' data-content='Este instrutor é uma pessoa interessada em colaborar com algum curso para troca de informações e aprimoramento de conhecimento da mesma forma que ocorre em fóruns de discussão sobre uma temática específica. Este instrutor pode ser remunerado ou não de acordo com cada coordenador/gerente de gota.'><img class='contact_suggest' src='/assets/img/user-6.png' width='300px' height='300px' style='cursor: pointer;'></a></span>";
        $list.="</div>";

        $list.="<div class='row' style='margin-left: 15px;margin-top: 35px;margin-right: 15px;text-align: center;'>";
        $list.="<span class='col-md-9'><a  data-trigger='hover' data-placement='top' href='#' onclick='return false;' data-toggle='popover' title='TORNE-SE UM USUÁRIO APRENDIZ' data-content='Estes seriam usuários de gotas que desejam criar os seus cursos, contribuindopara a gota com envio periódico de sugestões e informações. Ele não éremunerado, ganhando com a troca de informações e acesso a informações privilegiadas de acordo com a anuência de cada coordenador/gerente de gota.'><img class='contact_suggest'  src='/assets/img/user-4.png' width='300px' height='300px' style='cursor: pointer;'></a></span>";
        $list.="</div>";

        $list.="<div class='row' style='margin-left: 15px;margin-top: 35px;margin-right: 15px;text-align: center;'>";
        $list.="<span class='col-md-9'><a  data-trigger='hover' data-placement='top' href='#' onclick='return false;' data-toggle='popover' title='ANUNCIE CONOSCO' data-content=' Amplie seus negócios anunciando no nosso portal. Nossos usuários podem conhecer melhor seus produtos e serviços. Divulgue conosco seus cursos de graduação, pós-graduação, tutoriais e ferramentas de educação.'><img class='contact_suggest'  src='/assets/img/megaphone-1.png' width='300px' height='300px' style='cursor: pointer;'></a></span>";
        $list.="</div>";
        */

        return $list;
    }

    /**
     *
     */
    public function create_courses_data()
    {
        $query
                = "select * from mdl_course where category>0 and cost>0 order by fullname";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $courses[] = mb_convert_encoding($row->fullname, 'UTF-8');
        }
        $path = $_SERVER['DOCUMENT_ROOT'] . '/lms/custom/tmp/courses.json';
        file_put_contents($path, json_encode($courses));
    }

    /**
     * @param $item
     *
     * @return string
     */
    public function get_search_results($item)
    {
        $list       = "";
        $clear_item = urldecode($item);
        $query
                    = "select * from mdl_course where fullname like '%$clear_item%'";
        $result     = $this->db->query($query);
        $num        = $result->num_rows();
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
     *
     * @return string
     */
    function get_subs_modal_dialog($email)
    {
        $list = "";

        $list
            .= "<div id='myModal' class='modal fade' role='dialog'>
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
        $now  = time();
        $query
              = "insert into mdl_subscribers (name,email,status,added) 
                values ('$data->name','$data->email','1','$now')";
        $this->db->query($query);
    }

    /**
     * @return string
     */
    public function get_map_data()
    {
        $list = "";

        $i           = 0;
        $courses     = array();
        $courseslink = 'https://learningindrops.com/index.php/courses/all';
        $query       = "select * from mdl_course where top=1 order by fullname";
        $result      = $this->db->query($query);
        $num         = $result->num_rows();
        if ($num > 0) {
            foreach ($result->result() as $row) {
                $item        = new stdClass();
                $item->id    = $row->id;
                $item->name  = $row->fullname;
                $item->link  = "https://" . $_SERVER['SERVER_NAME']
                    . "/index.php/courses/full/$row->id";
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


            $list
                .= "<map name='image-map'>
                
            <area  alt='$link1' title='$name1' href='$link1' coords='103,240,0,156'    shape='rect'>
            <area  alt='$link2' title='$name2' href='$link2' coords='77,50,179,141'    shape='rect'>
            <area  alt='$link3' title='$name3' href='$link3' coords='293,111,207,2'   shape='rect'>
            <area  alt='$link4' title='$name4' href='$link4' coords='325,42,429,136'  shape='rect'>
            <area  alt='$link5' title='$name5' href='$link5' coords='396,241,501,154'  shape='rect'>
            <area  alt='All Cursos' title='All Cursos' href='$courseslink' coords='214,161,294,237'  shape='rect'>
            
            
            </map>";
        } // end if $num>0

        return $list;
    }

    /**
     * @return string
     */
    function get_courses_list_box($id)
    {
        $list = "";

        $list .= "<select id='suggest_course_$id' style='width:100%'>";
        $list .= "<option value='0' selected>Escolher</option>";

        $query  = "select * from mdl_course where cost>0";
        $result = $this->db->query($query);
        $num    = $result->num_rows();
        if ($num > 0) {
            foreach ($result->result() as $row) {
                $list .= "<option value='$row->id'>$row->fullname</option>";
            }
        } // end if $num > 0

        $list .= "</select>";

        return $list;
    }

    /**
     * @return string
     */
    function get_suggest_types($id)
    {
        $list = "";

        $list .= "<select id='suggest_type_$id' style='width:100%'>";
        $list .= "<option value='0' selected>Escolher</option>";
        $list .= "<option value='1'>Suggest Content</option>";
        $list .= "<option value='2'>Suggest Teacher</option>";
        $list .= "</select>";

        return $list;
    }

    /**
     * @return string
     */
    function get_suggest_box($item)
    {
        $list    = "";
        $data=json_decode($item);
        $id=$data->id;
        $title=$data->title;
        $types   = $this->get_suggest_types($id);
        $courses = $this->get_courses_list_box($id);

        $list
            .= "<div id='$id' class='modal fade' role='dialog'>
          <div class='modal-dialog'>
          <input type='hidden' id='modalid' value='$id'>
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>$title</h4>
              </div>
              <div class='modal-body' style=''>
              
              <div class='row'>
                <span class='col-md-4'>Selecione o Tipo de Sugestão*</span>
                <span class='col-md-8'>$types</span>
              </div>
              
              <div class='row'>
                <span class='col-md-4'>Please Select Course:*</span>
                <span class='col-md-8'>$courses</span>
              </div>
              
              <div class='row'>
                <span class='col-md-4'>Mensagem:*</span>
                <span class='col-md-8'><textarea  id='suggest_text_$id' style='width: 100%;'></textarea></span>
              </div>
              
              <div class='row'>
               <span class='col-md-4'>&nbsp;</span>
               <span class='col-md-8' id='suggest_err_$id' style='color: red;'></span>
              </div>
              
              </div>
              <div class='modal-footer' style='text-align: center;'>
                <button type='button' class='btn btn-primary' id='send_suggest_$id'>Enviar</button>
                <!--<button type='button' class='btn btn-primary' id='cancel_suggest'>Cancelar</button>-->
              </div>
            </div>
          </div>
        </div>";

        return $list;
    }

    function get_suggest_company($item)
    {
        $list = "";
        $data=json_decode($item);
        $id=$data->id;
        $title=$data->title;
        $list
            .= "<div id='$id' class='modal fade' role='dialog'>
          <div class='modal-dialog'>
            <div class='modal-content'>
            <input type='hidden' id='modalid' value='$id'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>$title</h4>
              </div>
              <div class='modal-body' style=''>
              
              <div class='row'>
                <span class='col-md-4'>Nome*</span>
                <span class='col-md-8'><input type='text' id='suggest_company_name_$id' style='width: 100%;'></span>
              </div>
              
               <div class='row'>
                <span class='col-md-4'>Email*</span>
                <span class='col-md-8'><input type='text' id='suggest_company_email_$id' style='width: 100%;'></span>
              </div>
              
               <div class='row'>
                <span class='col-md-4'>Telefone*</span>
                <span class='col-md-8'><input type='text' id='suggest_company_phone_$id' style='width: 100%;'></span>
              </div>
              
               <div class='row'>
                <span class='col-md-4'>Empresa*</span>
                <span class='col-md-8'><input type='text' id='suggest_company_company_$id' style='width: 100%;'></span>
              </div>
              
              <div class='row'>
                <span class='col-md-4'>Mensagem:*</span>
                <span class='col-md-8'><textarea  id='suggest_company_text_$id' style='width: 100%;'></textarea></span>
              </div>
              
              <div class='row'>
               <span class='col-md-4'>&nbsp;</span>
               <span class='col-md-8' id='suggest_err_company_$id' style='color: red;'></span>
              </div>
              
              </div>
              <div class='modal-footer' style='text-align: center;'>
                <button type='button' class='btn btn-primary' id='send_suggestcompany_$id'>Enviar</button>
                <!--<button type='button' class='btn btn-primary' id='cancel_suggest'>Cancelar</button>-->
              </div>
            </div>
          </div>
        </div>";

        return $list;
    }

    /**
     * @param $item
     */
    function send_suggest_item($item)
    {
        $data       = json_decode($item); // object
        $clear_text = addslashes($data->text);
        $userid     = 0; // guest user
        $now        = time();
        $query
                    = "insert into mdl_suggest 
                (courseid,
                userid,
                type,
                msg,
                added) 
                values ($data->courseid,
                        $userid,
                        $data->type,
                        '$clear_text',
                        '$now')";
        $this->db->query($query);
    }

    function send_suggest_contact($item)
    {
        $data = json_decode($item);
        echo "<pre>";
        print_r($data);
        echo "</pre>";

        $clear_name=addslashes($data->name);
        $clear_company=addslashes($data->company);
        $clear_text=addslashes($data->text);
        $now=time();

        $query="insert into mdl_contact_requests 
                            (name,
                            email,
                            phone,
                            company,
                            msg,
                            added) values ('$clear_name',
                                           '$data->email',
                                           '$data->phone',
                                           '$clear_company',
                                           '$clear_text','$now')";
        $this->db->query($query);

    }


}