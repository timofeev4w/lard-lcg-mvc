<!-- HEADER -->

<?php 
    require APPROOT . '/views/includes/header.php';

    // var_dump($data);
?>

<!-- CSS -->

<link rel="stylesheet" href="/public/css/posts/index.css">

<!-- SCRIPT -->

<script src="/public/js/posts/index.js"></script>
</head>
<body>

<!-- BODY -->

<div class="container">
    <?php foreach ($data['posts'] as $key => $post) : ?>
        <div class="row mb-3">
            <div class="col-6 offset-3 mt-3 single-post" id="<?php echo $post->id; ?>">
                <div class="row text-center p-2">
                    <h2>
                        <?php echo $post->title; ?>
                    </h2>
                </div>

                <div class="row p-2">
                    <?php echo $post->body; ?>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>


<!-- FOOTER -->
<?php 
    require APPROOT . '/views/includes/footer.php';
?>