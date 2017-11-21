<?php

/**
 * Description of Index
 *
 * @author sirromas
 */
class Index extends CI_Controller
{

    /**
     * Index constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('index_model');
    }

    /**
     *
     */
    public function index()
    {
        $this->load->view('header_view');
        $about_section = $this->index_model->get_about_section();
        $news_section = $this->index_model->get_news_section();
        $slider_section = $this->index_model->get_slider_section();
        $data = array('about_section' => $about_section,
                      'news_section' => $news_section,
                      'slider_section' => $slider_section);
        $this->load->view('index_view', $data);
        $this->load->view('footer_view');
    }

}
