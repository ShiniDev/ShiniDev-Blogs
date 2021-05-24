<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insert_post(string $title, string $category, string $content, string $preview)
    {
        $slug = url_title($title, 'dash', TRUE);
        $author = $_SESSION['user'];
        $date = new DateTime();
        $date_created = $date->format('n/j/Y, H:i');
        $statement = "INSERT INTO posts_data (title, author, category, content, preview, slug, date_created) VALUES ";
        $statement .= "(?,?,?,?,?,?,?)";
        $this->db->query($statement, [$title, $author, $category, $content, $preview, $slug, $date_created]);
    }

    public function post_exists(string $title): bool
    {
        $statement = "SELECT * FROM posts_data WHERE title = ?";
        $query = $this->db->query($statement, [$title]);
        return $query->num_rows() > 0 ? true : false;
    }

    public function get_posts()
    {
        $statement = "SELECT * FROM posts_data";
        return $this->db->query($statement);
    }

    public function get_posts_limit(int $offset, int $limit)
    {
        $statement = "SELECT * FROM posts_data LIMIT ?, ?";
        return $this->db->query($statement, [$offset, $limit])->result_array();
    }
}
