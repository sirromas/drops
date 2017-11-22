<?php

class Courses extends CI_Controller
{

    /**
     * Courses constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('courses_model');
    }

    /**
     *
     */
    public function preview()
    {
        $id = $this->uri->slash_segment(3);
        $item = $this->courses_model->get_course_preview($id);
        $data = array('items' => $item);
        $this->load->view('header_view');
        $this->load->view('course_preview', $data);
        $this->load->view('footer_view');
    }

    /**
     *
     */
    public function full()
    {
        $id = $this->uri->slash_segment(3);
        $item = $this->courses_model->get_course_page($id);
        $data = array('items' => $item);
        $this->load->view('header_view');
        $this->load->view('course_details', $data);
        $this->load->view('footer_view');
    }

    public function all () {
        $items = $this->courses_model->get_all_courses_page();
        $data = array('items' => $items);
        $this->load->view('header_view');
        $this->load->view('course_details', $data);
        $this->load->view('footer_view');
    }

}