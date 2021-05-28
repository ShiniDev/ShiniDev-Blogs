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

        $data['content']['total_post'] = $this->cms_model->get_posts()->num_rows();
        $data['content']['programming_category'] = $this->cms_model->get_specific_posts(['category'], ['programming'])->num_rows();
        $data['content']['devlogs_category'] = $this->cms_model->get_specific_posts(['category'], ['devlogs'])->num_rows();
        $data['content']['tips_category'] = $this->cms_model->get_specific_posts(['category'], ['tips'])->num_rows();
        $data['content']['projects_category'] = $this->cms_model->get_specific_posts(['category'], ['projects'])->num_rows();
        $data['content']['learnings_category'] = $this->cms_model->get_specific_posts(['category'], ['learnings'])->num_rows();

        $data['username'] = $_SESSION['user'];
        $data['current_tag'] = 'dashboard';
        $data['styles'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/cms/dashboard.css">';
        $data['content'] = $this->load->view('cms/dashboard', $data['content'], TRUE);
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
        $data['content']['total_pages'] = $data['content']['total_pages'] > 0 ? $data['content']['total_pages'] : 1;
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
            if ($this->cms_model->post_exists(["title"], [$title]))
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
    public function delete($id = '0')
    {
        redirect_not_login('userauth');
        if (!isset($_POST['secure']))
        {
            redirect(base_url() . 'cms/lists');
        }
        $res = $this->cms_model->delete_post((int)$id);
        if ($res) echo 'true';
        else echo 'false';
        unset($_POST['secure']);
        // $this->create();
    }
    public function update($id = '0')
    {
        redirect_not_login('userauth');
        date_default_timezone_set('Asia/Singapore');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $res = $this->cms_model->get_specific_posts(['id'], [(int)$id])->row_array();
        if (!empty($res))
        {
            if ($this->form_validation->run() === FALSE)
            {
                $data['styles'] = '
                <link rel="stylesheet" type="text/css" href="' . base_url() . 'css/cms/create.css">
                <link rel="stylesheet" type="text/css" href="' . base_url() . 'css/cms/update.css">
                ';
                $data['content']['res'] = $res;
                $data['content']['id'] = $id;
                $data['content']['hasError'] = false;
                $data['content'] = $this->load->view('cms/update', $data['content'], TRUE);
                $data['username'] = $_SESSION['user'];
                $this->load->view('templates/cms_template', $data);
            }
            else
            {
                $title = htmlspecialchars($_POST['title']);
                if ($this->cms_model->post_exists(["title"], [$title]) && $title !== $res['title'])
                {
                    $data['username'] = $_SESSION['user'];
                    $data['styles'] = '
                    <link rel="stylesheet" type="text/css" href="' . base_url() . 'css/cms/create.css">
                    <link rel="stylesheet" type="text/css" href="' . base_url() . 'css/cms/update.css">
                    ';
                    $data['content']['res'] = $res;
                    $data['content']['id'] = $id;
                    $data['content']['hasError'] = true;
                    $data['content'] = $this->load->view('cms/update', $data['content'], TRUE);
                    $this->load->view('templates/cms_template', $data);
                    return;
                }
                $previewContent = $_POST['blog-preview'];
                $content = $_POST['blog-content'];
                $category = $_POST['category'];
                $slug = url_title($title, '-', TRUE);
                $this->cms_model->update_post(['title', 'category', 'content', 'preview', 'slug'], [$title, $category, $content, $previewContent, $slug], ['id'], [(int)$id]);
                redirect(base_url() . 'cms/lists');
            }
        }
        else
        {
            // Redirect to error page if the $id parameter does not exist
            redirect(base_url() . 'error404');
        }
    }
    public function upload_image()
    {
        redirect_not_login('userauth');
        if (!isset($_FILES[0]))
        {
            redirect(base_url() . 'cms');
            return;
        }
        $this->cms_model->save_image();
    }
    public function save_data()
    {
        redirect_not_login('userauth');
        if (!isset($_POST['secure']) or $_POST['secure'] != 1)
        {
            redirect(base_url() . 'cms');
            return;
        }
        $this->cms_model->save_data();
    }
}
