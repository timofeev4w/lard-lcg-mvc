<?php 
    class Posts extends Controller
    {
        public function __construct()
        {
            $this->postModel = $this->model('Post');
            $this->commentModel = $this->model('Comment');
            $this->replyModel = $this->model('Reply');
        }

        // Show some posts for index page
        public function index()
        {
            $posts = $this->postModel->getSomePosts();

            $data = [
                'title' => 'Посты',
                'posts' => $posts
            ];
            
            $this->view('/posts/index', $data);
        }

        // Show post with comments and replies by post_id
        public function show(int $post_id = 1)
        {
            $post = $this->postModel->getOnePost($post_id);
            $comments = $this->commentModel->getSomeComments($post_id);
            $replies = $this->replyModel->getAllReplies($post_id);
            // var_dump($comments);
            // echo '<br>';
            // var_dump($replies);
            // echo '<br>';
            // print_r($comments);

            // Add replies to comments
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

            // print_r($data);

            $this->view('/posts/show', $data);
        }

        public function createComment()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'status' => '',
                    'username' => $_SESSION['username'],
                    'postId' => '',
                    'commentBody' => '',
                    'commentBodyError' => '',
                    'date' => date('Y-m-d H:i:s')
                ];

                $commentLength = 500;

                $data['postId'] = $_POST['post_id'];
                $data['commentBody'] = trim(htmlspecialchars($_POST['comment_body'], ENT_QUOTES));

                if (empty($data['commentBody'])) {
                    $data['commentBodyError'] = 'Комментарий не может быть пустым!';
                }elseif (strlen($data['commentBody']) > $commentLength) {
                    $data['commentBodyError'] = 'Комментарий не может быть длиннее'. $commentLength .'!';
                }

                if(empty($data['commentBodyError'])) {
                    if ($this->commentModel->saveComment($data['commentBody'], $_SESSION['id'], $data['postId'])) {
                        $data['status'] = true;
                    }else {
                        $data['status'] = false;
                    }
                }else {
                    $data['status'] = false;
                }

                echo(json_encode($data));
            }
        }
    }