<?php

class News extends CI_Controller
{

    /**
     * News constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
    }

    /**
     *
     */
    public function show()
    {
        $id = $this->uri->segment(3);
        $item = $this->news_model->get_news_content($id);
        $data = array('item' => $item);
        $this->load->view('header_view');
        $this->load->view('news_view', $data);
        $this->load->view('footer_view');
    }

    public function all()
    {
        $page = $this->news_model->get_news_page();
        $data = array('page' => $page);
        $this->load->view('header_view');
        $this->load->view('news_all_view', $data);
        $this->load->view('footer_view');
    }


}