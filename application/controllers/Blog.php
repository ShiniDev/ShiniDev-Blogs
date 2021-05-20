<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['content']['text'] = '';
        $data['current_tag'] = 'home';
        $data['title'] = 'Blog Article';
        $this->load->view('templates/blog_template', $data);
    }

    public function article($tags = "")
    {
        $data['content']['text'] = '';
        $data['current_tag'] = $tags;
        $data['title'] = 'Blog Article';
        $this->load->view('templates/blog_template', $data);
    }

    public function about()
    {
        $data['content']['text'] = '';
        $data['current_tag'] = 'about';
        $data['title'] = 'About Me';
        $this->load->view('templates/blog_template', $data);
    }
}
