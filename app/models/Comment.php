<?php 

    class Comment
    {
        public function __construct()
        {
            $this->db = new Database;
        }

        // Get some comments for current post
        public function getSomeComments($post_id) // last id
        {
            $this->db->query('SELECT c.id AS comment_id, c.body, c.user_id, c.post_id, c.created_at, c.updated_at, u.username FROM comments AS c, users AS u WHERE post_id = :post_id AND c.user_id = u.id ORDER BY updated_at DESC'); //LIMIT 20
            $this->db->bind(':post_id', $post_id);
            $comments = $this->db->resultSet();

            return $comments;
        }

        // Save comment by user
        public function saveComment($comment_body, $user_id, $post_id)
        {
            $this->db->query('INSERT comments (body, user_id, post_id, created_at, updated_at) VALUES (:body, :user_id, :post_id, :created_at, :updated_at)');
            $this->db->bind(':body', $comment_body);
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':post_id', $post_id);
            $this->db->bind(':created_at', date('Y-m-d H:i:s'));
            $this->db->bind(':updated_at', date('Y-m-d H:i:s'));

            if ($this->db->execute()) {
                return true;
            }else {
                return false;
            }
        }
    }