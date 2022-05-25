<?php 

    class Post
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        // Get some posts
        public function getSomePosts()
        {
            $this->db->query('SELECT * FROM posts LIMIT 10');
            $posts = $this->db->resultSet();

            return $posts;
        }

        // Get current post
        public function getOnePost($id)
        {
            $this->db->query('SELECT * FROM posts WHERE id = :id');
            $this->db->bind(':id', $id);
            $post = $this->db->single();

            return $post;
        }
    }