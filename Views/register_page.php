<?php require_once ROOT . '/Views/layouts/header.php'; ?>
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-lg-6">

                        <div class="errors">
                            <?php if ( $this->errors ):  ?>

                                <ul>

                                    <?php  foreach ( $this->errors as $error ): ?>

                                        <li><?= $error ?></li>

                                    <?php endforeach; ?>
                                </ul>

                            <?php endif; ?>
                        </div>

                        <form method="post" action="#">
                            <div class="form-group">
                                <label for="username">Ім'я користувача</label>
                                <input type="text" class="form-control" name="username" value="<?= isset($_POST['username'])? $_POST['username'] : '' ?>" placeholder="username" required>
                            </div>

                            <div class="form-group">
                                <label for="pass">Пароль</label>
                                <input type="password" class="form-control" name="pass1" required>
                            </div>
                            <div class="form-group">
                                <label for="pass">Повторіть пароль</label>
                                <input type="password" class="form-control" name="pass2" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Електронна адреса</label>
                                <input type="email" class="form-control" name="email" value="<?= isset($_POST['email'])? $_POST['email'] : '' ?>" placeholder="Email" required>
                            </div>

                            <div class="form-group form-captcha">
                                <label for="captcha">Капча</label>
                                <img class="captcha" id="captcha" src="/Modules/Captcha/Captcha.php"><br><br><br>
                                <input type="text" class="form-control" name="captcha" placeholder="Введіть капчу" required>
                            </div>
                            <input type="submit" class="btn btn-outline-success" name="register" value="Зареєструватися">
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

<?php require_once ROOT . '/Views/layouts/footer.php'; ?>