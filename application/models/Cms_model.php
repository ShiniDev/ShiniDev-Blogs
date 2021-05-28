<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 *  Insert Post
	 * 
	 *  A simple mysql query which creates a post
	 *  and inserts it to the posts_data table based
	 *  on the given parameter.
	 * 
	 *  @param string $title The title of the post
	 *  @param string $category The category of the post
	 *  @param string $content The content of the post
	 *  @param string $preview The preview of the post in blog articles
	 */
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
	/**
	 *  Delete Post
	 *  
	 *  A simple mysql query which deletes a post
	 *  based on the given id parameter.
	 * 
	 *  @param int $id The id of the post to be deleted
	 *  @return bool Whether the operation is successful or not
	 */
	public function delete_post(int $id): bool
	{
		if (!$this->post_exists(["id"], [$id]))
		{
			return false;
		}
		$statement = "DELETE FROM posts_data WHERE id = ?";
		$this->db->query($statement, [$id]);
		return true;
	}
	/**
	 *  Post Exists
	 *  
	 *  Checks if the posts exists based on the given
	 *  parameters. The parameters are array and can be 
	 *  of any length as long as it is valid to SQL.
	 * 
	 *  @param array $column the column data field
	 *  @param array $data the data for column field
	 *  @return bool Returns true if it exists, else false
	 */
	public function post_exists(array $column, array $data): bool
	{
		$statement = "SELECT * FROM posts_data WHERE ";
		for ($i = 0; $i < count($column); ++$i)
		{
			$statement .= $i + 1 < count($column) ? $column[$i] . " = ?, " : $column[$i] . " = ? ";
		}
		$query = $this->db->query($statement, $data);
		return $query->num_rows() > 0 ? true : false;
	}
	/**
	 *  Get Posts
	 * 
	 *  A simple SQL query that selects all post data
	 */
	public function get_posts()
	{
		$statement = "SELECT * FROM posts_data";
		return $this->db->query($statement);
	}
	/**
	 *  Get Posts Limit
	 * 
	 *  A simple SQL query that selects all post data prior 
	 *  to the $offset and $limit. Returns the result as an array
	 * 
	 *  @param int $offset The offset to be used 
	 *  @param int $limit How many posts data to acquire
	 *  @return array The results
	 */
	public function get_posts_limit(int $offset, int $limit): array
	{
		$statement = "SELECT * FROM posts_data LIMIT ?, ?";
		return $this->db->query($statement, [$offset, $limit])->result_array();
	}
	/**
	 *  Get Specific Post
	 *  
	 *  Gets the specific post based on the given
	 *  parameters. The parameters are array and can be 
	 *  of any length as long as it is valid to SQL.
	 * 
	 *  @param array $column the column data field
	 *  @param array $data the data for column field
	 *  @return resource 
	 */
	public function get_specific_posts(array $column, array $data)
	{
		$statement = "SELECT * FROM posts_data WHERE ";
		for ($i = 0; $i < count($column); ++$i)
		{
			$statement .= $i + 1 < count($column) ? $column[$i] . " = ?, " : $column[$i] . " = ? ";
		}
		return $this->db->query($statement, $data);
	}
	public function get_specific_posts_limit(array $column, array $data, int $offset, int $limit)
	{
		$statement = "SELECT * FROM posts_data WHERE ";
		for ($i = 0; $i < count($column); ++$i)
		{
			$statement .= $i + 1 < count($column) ? $column[$i] . " = ?, " : $column[$i] . " = ? ";
		}
		$statement .= " LIMIT ?, ?";
		array_push($data, $offset, $limit);
		return $this->db->query($statement, $data);
	}
	public function update_post(array $update_column, array $update_data, array $where_column, array $where_data)
	{
		$statement = "UPDATE posts_data SET ";
		for ($i = 0; $i < count($update_column); ++$i)
		{
			$statement .= $i + 1 < count($update_column) ? $update_column[$i] . " = ?, " : $update_column[$i] . " = ? ";
		}
		$statement .= "WHERE ";
		for ($i = 0; $i < count($where_column); ++$i)
		{
			$statement .= $i + 1 < count($where_column) ? $where_column[$i] . " = ?, " : $where_column[$i] . " = ? ";
		}
		for ($i = 0; $i < count($where_data); ++$i)
		{
			array_push($update_data, $where_data[$i]);
		}
		$this->db->query($statement, $update_data);
	}
	/**
	 *  Save Image
	 * 
	 *  It saves all the images in $_FILES superglobal to the
	 *  images directory. Clears $_FILES superglobal afterwards
	 */
	public function save_image()
	{
		foreach ($_FILES as $images)
		{
			$name = $images['name'];
			move_uploaded_file($images['tmp_name'], './images/' . $name);
		}
		//Clear, to prevent unwanted access
		$_FILES = [];
	}
	/**
	 *  Save Data
	 *  
	 *  It saves the current form state while creating a post.
	 *  It is used in create.php every 5 seconds to preserve
	 *  and save data.
	 */
	public function save_data()
	{
		$_SESSION['formdata']['title'] = $_POST['title'];
		$_SESSION['formdata']['preview'] = $_POST['preview'];
		$_SESSION['formdata']['content'] = $_POST['content'];
		$_SESSION['formdata']['images'] = $_POST['images'];
		$_SESSION['formdata']['category'] = $_POST['category'];
		$_POST['secure'] = 0;
		unset($_POST['secure']);
	}
}
