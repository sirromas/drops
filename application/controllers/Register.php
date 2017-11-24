<?php

class Register extends CI_Controller
{

    /**
     * Register constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('register_model');
        $this->load->library('session');
    }

    /**
     *
     */
    public function register()
    {
        $page = $this->register_model->get_no_course_register_page();
        $data = array('page' => $page);
        $this->load->view('header_view');
        $this->load->view('register_view', $data);
        $this->load->view('footer_view');
    }

    /**
     *
     */
    public function preselect()
    {
        $id = $this->uri->segment(3);
        $page = $this->register_model->get_course_register_page($id);
        $data = array('page' => $page);
        $this->load->view('header_view');
        $this->load->view('register_view', $data);
        $this->load->view('footer_view');
    }

    /**
     *
     */
    public function payment_done()
    {
        $data = $_REQUEST;
        $page = $this->register_model->get_payment_confirmation_page($data);
        $data = array('page' => $page);
        $this->load->view('header_view');
        $this->load->view('register_view', $data);
        $this->load->view('footer_view');
    }

    /**
     *
     */
    public function get_terms_box()
    {
        $box = $this->register_model->get_terms_modal_box();
        echo $box;
    }

    /**
     *
     */
    public function get_category_courses()
    {
        $id = $_POST['id'];
        $courses = $this->register_model->get_category_courses($id);
        echo $courses;
    }

    /**
     *
     */
    public function confirm_order()
    {
        $data = $this->uri->segment(3);
        $this->session->set_userdata('email', $data);
        $page = $this->register_model->get_order_confirmation_page($data);
        $data = array('page' => $page);
        $this->load->view('header_view');
        $this->load->view('register_view', $data);
        $this->load->view('footer_view');
    }


    /**
     *
     */
    public function is_email_exist()
    {
        $email = $this->input->post('email');
        $status = $this->register_model->is_email_exists($email);
        echo $status;
    }


}