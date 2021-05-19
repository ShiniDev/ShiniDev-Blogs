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
        if (!(isset($_SESSION['user']) && isset($_SESSION['loggedin']))) {
            redirect(base_url('userauth'));
        }
    }
}
