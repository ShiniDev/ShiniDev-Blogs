<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        redirect_not_login('userauth');
        $data['username'] = $_SESSION['user'];
        $data['current_tag'] = 'dashboard';
        $this->load->view('templates/cms_template', $data);
    }
    public function lists()
    {
        redirect_not_login('userauth');
        $data['username'] = $_SESSION['user'];
        $data['current_tag'] = 'lists';
        $this->load->view('templates/cms_template', $data);
    }
    public function create()
    {
        redirect_not_login('userauth');
        $this->form_validation->set_rules('title', 'Title', 'required');
        if ($this->form_validation->run() === FALSE) {
            $data['username'] = $_SESSION['user'];
            $data['styles'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/cms/create.css">';
            $data['content'] = $this->load->view('cms/create', [], TRUE);
            $data['current_tag'] = 'create';
            $this->load->view('templates/cms_template', $data);
        }
    }
    public function upload_image()
    {
        if (!isset($_FILES[0])) {
            // redirect(base_url() . 'cms');
            return;
        }
        foreach ($_FILES as $images) {
            $name = $images['name'];
            move_uploaded_file($images['tmp_name'], './images/' . $name);
        }
        //Clear, to prevent unwanted access
        $_FILES = [];
    }
}
