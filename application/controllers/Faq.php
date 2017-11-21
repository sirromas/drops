<?php

class Faq extends CI_Controller
{

    /**
     * Faq constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('faq_model');
    }

    public function show()
    {
        $item = $this->faq_model->get_faq_content();
        $data = array('item' => $item);
        $this->load->view('header_view');
        $this->load->view('faq_view', $data);
        $this->load->view('footer_view');
    }

}