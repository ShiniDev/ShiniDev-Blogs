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
    public function posts()
    {
        redirect_not_login('userauth');
        $data['username'] = $_SESSION['user'];
        $data['current_tag'] = 'posts';
        $this->load->view('templates/cms_template', $data);
    }
}
