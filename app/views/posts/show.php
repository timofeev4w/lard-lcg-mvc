<!-- HEADER -->

<?php 
    require APPROOT . '/views/includes/header.php';

?>

<!-- CSS -->

<link rel="stylesheet" href="/public/css/posts/show.css">

<!-- SCRIPT -->

<!-- <script src="/public/js/posts/index.js"></script> -->
</head>
<body>

<!-- BODY -->

<div class="container">
    <!-- POST -->
    <div class="row mb-3">
        <div class="col-6 offset-3 mt-3 single-post">
            <div class="row text-center p-2">
                <h2>
                    <?php echo $data['post']->title; ?>
                </h2>
            </div>

            <div class="row p-2">
                <?php echo $data['post']->body; ?>
            </div>

        </div>
    </div>

    <!-- COMMENTS -->
    <?php foreach($data['comments'] as $comment) : ?>
        <div class="row">
            <div class="col-6 offset-3 mt-3 pb-2 single-comment">
                <div class="row">
                    <b>
                        <?php echo $comment->username; ?>
                    </b>
                </div>

                <div class="row">
                    <p>
                        <?php echo $comment->body; ?>
                    </p>
                </div>

                <div class="row">
                    <small>
                        <?php echo $comment->updated_at; ?>
                    </small>
                </div>

                <!-- <div> -->
                    <?php if(isset($comment->replies)) : ?>
                        <?php foreach($comment->replies as $reply) : ?>
                            <div class="ms-4 ps-1 pb-1 single-reply">
                                <div class="row">
                                    <b>
                                        <?php echo $reply->reply_author; ?>
                                    </b>
                                </div>

                                <div class="row">
                                    <p>
                                        <?php echo $reply->body; ?>
                                    </p>
                                </div>

                                <div class="row">
                                    <small>
                                        <?php echo $reply->updated_at; ?>
                                    </small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <!-- </div> -->
            </div>

            <!-- <?php if(isset($comment->replies)) : ?>
                <?php foreach($comment->replies as $reply) : ?>
                    <div class="col-6 offset-3 mt-3 ps-4 single-reply">
                        <div class="row">
                            <b>
                                <?php echo $reply->reply_author; ?>
                            </b>
                        </div>

                        <div class="row">
                            <p>
                                <?php echo $reply->body; ?>
                            </p>
                        </div>

                        <div class="row">
                            <small>
                                <?php echo $reply->updated_at; ?>
                            </small>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?> -->
        </div>
    <?php endforeach; ?>
    
</div>


<!-- FOOTER -->
<?php 
    require APPROOT . '/views/includes/footer.php';
?>