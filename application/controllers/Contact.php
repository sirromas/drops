<?php

class Contact extends CI_Controller
{

    /**
     * Contact constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('contact_model');
    }

    /**
     *
     */
    public function show()
    {
        $item = $this->contact_model->get_contact_page();
        $data = array('item' => $item);
        $this->load->view('header_view');
        $this->load->view('contact_view', $data);
        $this->load->view('footer_view');
    }


}