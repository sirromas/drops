<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends CI_Controller
{



    public function index()
    {
        $this->load->view('welcome_message');
    }


    public function courses()
    {
        $this->load->view('header_view');
        $this->load->view('courses_view');
        $this->load->view('footer_view');
    }

    public function login() {
        $this->load->view('header_view');
        $this->load->view('login_view');
        $this->load->view('footer_view');
    }
}
