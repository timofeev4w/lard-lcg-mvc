<?php 

    class Reply
    {
        public function __construct()
        {
            $this->db = new Database;
        }

        // Get all replies by post_id
        public function getAllReplies($post_id) // last id
        {
            $this->db->query('SELECT r.comment_id, r.body, r.created_at, r.updated_at, u.username AS reply_author FROM comments AS c, users AS u, comment_replies AS r WHERE post_id = :post_id AND r.comment_id = c.id AND r.user_id = u.id');
            $this->db->bind(':post_id', $post_id);
            $replies = $this->db->resultSet();

            return $replies;
        }
    }