<?php


class Index_model extends CI_Model
{

    public $host;

    /**
     * Index_model_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

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
        
        
                            <div id='myCarousel' class='carousel slide' data-ride='carousel'>
        
                                <ol class='carousel-indicators'>
                                    <li data-target='#myCarousel' data-slide-to='0' class='active'></li>
                                    <li data-target='#myCarousel' data-slide-to='1'></li>
                                    <li data-target='#myCarousel' data-slide-to='2'></li>
                                </ol>
        
        
                                <div class='carousel-inner'>
                                    
                                    <div class='item'>
                                        <img class='mb2slider-slide-img'
                                             src='" . $slides['Slide2'] . "'
                                             alt='01_comp_20170917.jpg' style='z-index:0;max-width:100%;'>
                                    </div>
        
                                    <div class='item'>
                                        <img class='mb2slider-slide-img'
                                             src='" . $slides['Slide3'] . "'
                                             alt='03_comp_20170917.jpg' style='z-index:0;max-width:100%;'>
                                    </div>
        
                                    <div class='item active'>
                                        <img class='mb2slider-slide-img'
                                             src='" . $slides['Slide1'] . "'
                                             alt='02_comp_20170917.jpg' style='z-index:0;max-width:100%;'>
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

        $list.="<div class='col-sm-6' id=''>

                                            <div class='theme-boxes col-2 clearfix' id=''>";

        foreach ($result->result() as $row) {
            $title = $row->title;
            $id = $row->id;
            $path = "n$i.jpg";
            $http_path = "http://" . $_SERVER['SERVER_NAME'] . "/clientes/drops/assets/img/$path";
            $url = "http://" . $_SERVER['SERVER_NAME'] . "/clientes/drops/index.php/news/show/$id";

            $list.="<div class='theme-box'>
                             <a href='$url'>
                                   <div class='theme-boximg' >
                                      <h4>$title</h4>
                                      <div class='theme-boximg-color' style='background-color:#e63946;'></div>
                                      <div class='theme-boximg-img'></div>
                                      </div>
                              </a></div>";
            $i++;
        } // end foreach





        $list.="</div></div>";

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
        $url='http://'.$_SERVER['SERVER_NAME'].'/clientes/drops/index.php/about/show';
        $list .= "<div class='col-sm-6' id=''>
                <div class='theme-title title-left title-n style-1'style='margin:0 0 30px 0;' id=''>
                <h4 class='title'><span>Some Word About Us</span></h4></div>
                <p id='yui_3_17_2_2_1510781966338_114'>$preface</p>
                <a href='$url'  class='btn btn-primary btn-lg btn-icon-before' style='margin:20px 0 0 0'><span class='btn-text'>Read more</span></a>
                </div>";
        return $list;

    }

}