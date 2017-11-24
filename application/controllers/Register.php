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
        $this->load->library('email');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.theberry.us',
            'smtp_port' => 25,
            'smtp_user' => 'info@theberry.us',
            'smtp_pass' => 'aK6SKymc*',
            'mailtype' => 'html'
        );
        $this->email->initialize($config);
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
        $data2 = $this->register_model->get_payment_confirmation_page($data);
        $page = $data2['page'];
        $status = $data2['status'];
        $user = $data2['user'];

        if ($status == 0) {
            $this->email->from('info@theberry.us', 'Learning Drops Support Team');
            $this->email->to($user->email);
            $this->email->cc('sirromas@gmail.com');
            $this->email->bcc('helainefpsantos@gmail.com');

            $msg = $this->register_model->get_registration_confirmation_email($user);
            $this->email->subject('Registration Confirmation');
            $this->email->message($msg);
            $this->email->send();
        }

        $vdata = array('page' => $page);
        $this->load->view('header_view');
        $this->load->view('register_view', $vdata);
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