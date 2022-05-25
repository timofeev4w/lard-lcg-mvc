<!-- HEADER -->
<?php 
    require APPROOT . '/views/includes/header.php';

    // var_dump($data);
?>
<!-- CSS -->

</head>
<body>

<!-- BODY -->

<div class="container">
    <div class="row">
        <div class="col-6 offset-3 pt-4">
            <div class="row mb-4 text-center">
                <h1>
                    Регистрация
                </h1>
            </div>

            <form action="/users/register" method="post">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingEmail" placeholder="Email" name="email" value="<?php echo $data['email']; ?>">
                    <label for="floatingEmail">Email</label>
                    <small class="text-danger">
                        <?php echo $data['emailError'] ?>
                    </small>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Имя пользователя" name="username" value="<?php echo $data['username']; ?>">
                    <label for="floatingInput">Имя пользователя</label>
                    <small class="text-danger">
                        <?php echo $data['usernameError'] ?>
                    </small>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Пароль" name="password">
                    <label for="floatingPassword">Пароль</label>
                    <small class="text-danger">
                        <?php echo $data['passwordError'] ?>
                    </small>
                </div>

                <div class="row mb-2">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success" type="submit">Зарегистрироваться</button>
                    </div>
                </div>

                <div class="row">
                    <div class="d-flex justify-content-center">
                        <a href="/users/login">Есть аккаунт?</a>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</div>


<!-- FOOTER -->

<?php 
    require APPROOT . '/views/includes/footer.php';
?>