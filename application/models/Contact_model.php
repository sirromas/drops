<?php

class Contact_model extends CI_Model
{


    /**
     * Contact_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_contact_page()
    {

        $list = '';

        return $list;
    }
}