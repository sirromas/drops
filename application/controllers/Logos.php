<?php

class Logos extends CI_Controller
{

    /**
     * About constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('logos_model');
    }


    /**
     *
     */
    public function show()
    {
        $item = $this->logos_model->get_logos_page();
        $data = array('item' => $item);
        $this->load->view('header_view');
        $this->load->view('logos_view', $data);
        $this->load->view('footer_view');
    }
}