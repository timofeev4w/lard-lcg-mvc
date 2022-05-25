<?php 

    class Comment
    {
        public function __construct()
        {
            $this->db = new Database;
        }

        public function getSomeComments($post_id) // last id
        {
            $this->db->query('SELECT c.id AS comment_id, c.body, c.user_id, c.post_id, c.created_at, c.updated_at, u.username FROM comments AS c, users AS u WHERE post_id = :post_id AND c.user_id = u.id'); //LIMIT 20
            $this->db->bind(':post_id', $post_id);
            $comments = $this->db->resultSet();

            return $comments;
        }

        public function getAllReplies($post_id) // last id
        {
            $this->db->query('SELECT r.comment_id, r.body, r.created_at, r.updated_at, u.username AS reply_author FROM comments AS c, users AS u, comment_replies AS r WHERE post_id = :post_id AND r.comment_id = c.id AND r.user_id = u.id');
            $this->db->bind(':post_id', $post_id);
            $replies = $this->db->resultSet();

            return $replies;
        }
    }