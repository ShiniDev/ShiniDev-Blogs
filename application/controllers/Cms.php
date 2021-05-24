<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cms_model');
    }
    public function index()
    {
        redirect_not_login('userauth');
        $data['username'] = $_SESSION['user'];
        $data['current_tag'] = 'dashboard';
        $this->load->view('templates/cms_template', $data);
    }
    public function lists(int $page = 1, int $limit = 10)
    {
        // Security
        redirect_not_login('userauth');
        if ($page < 1)
        {
            $data['content']['page'] = 1;
            $page = 1;
        }
        if ($limit < 5)
        {
            $limit = 5;
        }
        else if ($limit > 100)
        {
            $limit = 100;
        }

        // Data for template
        $data['username'] = $_SESSION['user'];

        // Data for content
        $res = $this->cms_model->get_posts();
        $total_posts = $res->num_rows();
        $data['content']['total_pages'] = (int)ceil((float)$total_posts / (float)$limit);
        if ($page > $data['content']['total_pages']) $page = $data['content']['total_pages'];
        $offset = ($page - 1) * $limit;
        $data['content']['db'] =  $this->cms_model->get_posts_limit($offset, $limit);
        $data['content']['page'] = $page;
        $data['content']['limit'] = $limit;

        // Rules
        if ($page < 1) $data['content']['page'] = 1;
        if ($page > $data['content']['total_pages']) $data['content']['page'] = $data['content']['total_pages'];

        // View
        $data['styles'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/cms/lists.css">';
        $data['content'] = $this->load->view('cms/lists', $data['content'], TRUE);
        $data['current_tag'] = 'lists';
        $this->load->view('templates/cms_template', $data);
    }
    public function create()
    {
        redirect_not_login('userauth');
        date_default_timezone_set('Asia/Singapore');
        $this->form_validation->set_rules('title', 'Title', 'required');
        if ($this->form_validation->run() === FALSE)
        {
            $data['username'] = $_SESSION['user'];
            $data['styles'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/cms/create.css">';
            $data['content']['hasError'] = false;
            $data['content'] = $this->load->view('cms/create', $data['content'], TRUE);
            $data['current_tag'] = 'create';
            $this->load->view('templates/cms_template', $data);
        }
        else
        {
            $title = htmlspecialchars($_POST['title']);
            if ($this->cms_model->post_exists($title))
            {
                $data['username'] = $_SESSION['user'];
                $data['styles'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/cms/create.css">';
                $data['content']['hasError'] = true;
                $data['content'] = $this->load->view('cms/create', $data['content'], TRUE);
                $data['current_tag'] = 'create';
                $this->load->view('templates/cms_template', $data);
                return;
            }
            $previewContent = $_POST['blog-preview'];
            $content = $_POST['blog-content'];
            $category = $_POST['category'];
            $this->cms_model->insert_post($title, $category, $content, $previewContent);
            unset($_SESSION['formdata']); // Removed saved formdata when creating post
            redirect(base_url() . 'cms/lists');
        }
    }
    public function upload_image()
    {
        if (!isset($_FILES[0]))
        {
            redirect(base_url() . 'cms');
            return;
        }
        foreach ($_FILES as $images)
        {
            $name = $images['name'];
            move_uploaded_file($images['tmp_name'], './images/' . $name);
        }
        //Clear, to prevent unwanted access
        $_FILES = [];
    }
    public function save_data()
    {
        if (!isset($_POST['secure']) or $_POST['secure'] != 1)
        {
            redirect(base_url() . 'cms');
            return;
        }
        $_SESSION['formdata']['title'] = $_POST['title'];
        $_SESSION['formdata']['preview'] = $_POST['preview'];
        $_SESSION['formdata']['content'] = $_POST['content'];
        $_SESSION['formdata']['images'] = $_POST['images'];
        $_SESSION['formdata']['category'] = $_POST['category'];
        $_POST['secure'] = 0;
        unset($_POST['secure']);
    }
}
