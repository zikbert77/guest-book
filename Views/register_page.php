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
                                <label for="username"><?= USERNAME ?> <?= USERNAME_DESC ?></label>
                                <input type="text" class="form-control" name="username" value="<?= isset($_POST['username'])? $_POST['username'] : '' ?>" placeholder="<?= USERNAME ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="pass"><?= PASSWORD ?> <?= PASSWORD_DESC ?></label>
                                <input type="password" class="form-control" name="pass1" required>
                            </div>
                            <div class="form-group">
                                <label for="pass"><?= PASSWORD2 ?></label>
                                <input type="password" class="form-control" name="pass2" required>
                            </div>

                            <div class="form-group">
                                <label for="email"><?= EMAIL ?></label>
                                <input type="email" class="form-control" name="email" value="<?= isset($_POST['email'])? $_POST['email'] : '' ?>" placeholder="<?= EMAIL ?>" required>
                            </div>

                            <div class="form-group form-captcha">
                                <label for="captcha"><?= CAPTCHA ?></label>
                                <img class="captcha" id="captcha" src="/Modules/Captcha/Captcha.php"><br><br><br>
                                <input type="text" class="form-control" name="captcha" placeholder="<?= ENTER_CAPTCHA ?>" required>
                            </div>
                            <input type="submit" class="btn btn-outline-success" name="register" value="<?= REGISTER ?>">
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

<?php require_once ROOT . '/Views/layouts/footer.php'; ?>