<?php

class About extends CI_Controller
{

    /**
     * About constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('about_model');
    }

    /**
     *
     */
    public function show()
    {
        $item = $this->about_model->get_about_content();
        $data = array('item' => $item);
        $this->load->view('header_view');
        $this->load->view('news_view', $data);
        $this->load->view('footer_view');
    }

}