<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cms_model');
    }

    // Goes to the home page of the blogsite
    public function index(int $page = 1)
    {
        $limit = 10;
        $total_posts = $this->cms_model->get_posts()->num_rows();
        $total_page = (int)ceil((float)$total_posts / (float)$limit);
        if ($total_page == 0) $total_page = 1;
        if ($page < 1)
        {
            $page = 1;
        }
        else if ($page > $total_page)
        {
            $page = $total_page;
        }
        $offset = ($page - 1) * $limit;

        $data['content']['db'] = $this->cms_model->get_posts_limit($offset, $limit);
        $data['content']['page'] = $page;
        $data['content']['total_page'] = $total_page;
        $data['content'] = $this->load->view('blog/index', $data['content'], TRUE);
        $data['styles'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/blog/index.css">';
        $data['current_tag'] = 'home';
        $data['title'] = 'Home';
        $this->load->view('templates/blog_template', $data);
    }
    // Goes to the article parameter
    public function category($tags = "", int $page = 1)
    {
        $limit = 10;
        $total_posts = $this->cms_model->get_specific_posts(['category'], [$tags])->num_rows();
        $total_page = (int)ceil((float)$total_posts / (float)$limit);
        if ($total_page == 0) $total_page = 1;
        if ($page < 1)
        {
            $page = 1;
        }
        else if ($page > $total_page)
        {
            $page = $total_page;
        }
        $offset = ($page - 1) * $limit;
        $data['content']['db'] = $this->cms_model->get_specific_posts_limit(['category'], [$tags], $offset, $limit)->result_array();
        $data['content']['page'] = $page;
        $data['content']['category'] = $tags;
        $data['content']['total_page'] = $total_page;
        $data['content'] = $this->load->view('blog/index', $data['content'], TRUE);
        $data['styles'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/blog/index.css">';
        $data['current_tag'] = $tags;
        $data['title'] = $tags;
        $this->load->view('templates/blog_template', $data);
    }
    public function post($slug)
    {
        $res = $this->cms_model->get_specific_posts(['slug'], [$slug]);
        if ($res->num_rows())
        {
            $res = $res->row_array();
            $data['title'] = $res['title'];
            $data['content']['db'] = $res;
            $data['content'] = $this->load->view('blog/post', $data['content'], TRUE);
            $data['styles'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/blog/post.css">';
            $this->load->view('templates/blog_template', $data);
        }
        else
        {
            $this->error('Post does not exists');
        }
    }
    // Goes to the page about me
    public function about()
    {
        $data['content'] = $this->load->view('blog/about', [], TRUE);
        $data['current_tag'] = 'about';
        $data['title'] = 'About Me';
        $data['styles'] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/blog/about.css">';
        $this->load->view('templates/blog_template', $data);
    }
    public function error($text = 'Page not found')
    {
        $data['title'] = 'Error';
        $data['content']['text'] = $text;
        $this->load->view('templates/blog_template', $data);
    }
}
