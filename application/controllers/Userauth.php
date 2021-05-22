<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userauth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('userauth_model');
    }
    public function index()
    {
        redirect_if_login('cms');
        redirect(base_url('userauth/login'));
    }
    private function register()
    {
        redirect_if_login('cms');
        // Do not erase, removing would always set run() to false
        $this->form_validation->set_rules('username', 'Username', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('userauth/register');
        } else {
            $name = html_escape($this->input->post('username'));
            $pass = html_escape($this->input->post('password'));
            $this->userauth_model->insert_user($name, $pass);
            redirect(base_url('userauth/login'));
        }
    }
    public function login()
    {
        redirect_if_login('cms');
        // Do not erase, removing would always set run() to false
        $this->form_validation->set_rules('username', 'Username', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('userauth/login');
        } else {
            $name = html_escape($this->input->post('username'));
            $pass = html_escape($this->input->post('password'));
            $err_stat = $this->userauth_model->verify_user($name, $pass);
            if ($err_stat === 2) {
                $data['error_msg'] = 'Incorrect username or password';
            } else if ($err_stat === 1) {
                $data['error_msg'] = 'Incorrect username or password';
            } else {
                $_SESSION['user'] = $name;
                $_SESSION['loggedin'] = true;
                redirect(base_url() . 'cms/');
                return;
            }
            $this->load->view('userauth/login', $data);
        }
    }
    public function logout()
    {
        redirect_not_login('userauth/login');
        session_destroy();
        redirect(base_url());
    }
}
