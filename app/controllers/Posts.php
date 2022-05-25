<?php 
    class Posts extends Controller
    {
        public function __construct()
        {
            $this->postModel = $this->model('Post');
            $this->commentModel = $this->model('Comment');
        }

        public function index()
        {
            $posts = $this->postModel->getSomePosts();

            $data = [
                'title' => 'Посты',
                'posts' => $posts
            ];
            
            $this->view('/posts/index', $data);
        }

        public function show(int $id = 1)
        {
            $post = $this->postModel->getOnePost($id);
            $comments = $this->commentModel->getSomeComments($id);
            $replies = $this->commentModel->getAllReplies($id);
            // var_dump($comments);
            // echo '<br>';
            var_dump($replies);
            echo '<br>';
            // print_r($comments);

            foreach ($comments as $key => $comment) {
                foreach ($replies as $key => $reply) {
                    if ($comment->comment_id == $reply->comment_id) {
                        $comment->replies[] = $reply;
                    }
                }
            }
            
            $data = [
                'post' => $post,
                'comments' => $comments,
                // 'replies' => $replies
            ];

            print_r($data);

            $this->view('/posts/show', $data);
        }
    }