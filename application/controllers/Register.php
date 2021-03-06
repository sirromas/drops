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
            'smtp_host' => 'smtp.learningindrops.com',
            'smtp_port' => 25,
            'smtp_user' => 'info@learningindrops.com',
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
     * @param int $length
     * @return string
     */
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     *
     */
    public function payment_done()
    {
        $data = $_REQUEST;
        $pwd = $this->generateRandomString(8);
        $data2 = $this->register_model->get_payment_confirmation_page($data, $pwd);
        $page = $data2['page'];
        $status = $data2['status'];
        $user = $data2['user'];

        if ($status == 0) {
            $this->email->from('info@learningindrops.com', 'Learning Drops Support Team');
            $this->email->to($user->email);
            $this->email->cc('sirromas@gmail.com');
            $this->email->bcc('helainefpsantos@gmail.com');

            $already_sent = $this->register_model->is_receipt_sent($user->transactionid);
            if ($already_sent == 0) {
                $msg = $this->register_model->get_registration_confirmation_email($user, $pwd);
                $this->email->subject('Registration Confirmation');
                $this->email->message($msg);
                $this->email->send();
                $this->register_model->make_receipt_sent($user->transactionid);
            }
        }
        $vdata = array('page' => $page);
        $this->load->view('header_view');
        $this->load->view('register_view', $vdata);
        $this->load->view('footer_view');
    }

    /**
     *
     */
    public function payment_student_done()
    {
        $data = $_REQUEST;
        $data2 = $this->register_model->get_student_payment_confirmation_page($data);
        $page = $data2['page'];
        $user = $data2['user'];
        $this->email->from('info@learningindrops.com', 'Learning Drops Support Team');
        $this->email->to($user->email);
        $this->email->cc('sirromas@gmail.com');
        $this->email->bcc('helainefpsantos@gmail.com');

        $already_sent = $this->register_model->is_receipt_sent($user->transactionid);
        if ($already_sent == 0) {
            $msg = $this->register_model->get_payment_confirmation_email($user);
            $this->email->subject('Payment Confirmation');
            $this->email->message($msg);
            $this->email->send();
            $this->register_model->make_receipt_sent($user->transactionid);
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