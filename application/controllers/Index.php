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
        $this->load->helper('url');
    }

    /**
     *
     */
    public function index()
    {
        $about_section = $this->index_model->get_about_section();
        $news_section = $this->index_model->get_news_section();
        $slider_section = $this->index_model->get_slider_section();
        $map_data = $this->index_model->get_map_data();
        $this->index_model->create_courses_data(); // creates courses JSON data
        $announcements=$this->index_model->get_announcements_block();
        $data = array('about_section' => $about_section,
                      'news_section' => $news_section,
                      'slider_section' => $slider_section,
                       'announcements'=>$announcements) ;

        $data2 = array('map_data' => $map_data);

        $this->load->view('header_view');
        $this->load->view('index_view', $data);
        $this->load->view('footer_view', $data2);
    }

    /**
     *
     */
    public function search()
    {
        $item = $this->uri->segment(3);
        $courses = $this->index_model->get_search_results(base64_decode($item));
        $data = array('items' => $courses);
        $this->load->view('header_view');
        $this->load->view('search_view', $data);
        $this->load->view('footer_view');
    }

    /**
     *
     */
    public function get_subs_modal_dialog()
    {
        $email = $this->input->post('email');
        $dialog = $this->index_model->get_subs_modal_dialog($email);
        echo $dialog;
    }

    /**
     * @param $item
     */
    public function add_subscriber($item)
    {
        $item = $this->input->post('item');
        $this->index_model->add_subscriber($item);
    }

}
