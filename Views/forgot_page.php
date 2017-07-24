<?php require_once ROOT . '/Views/layouts/header.php'; ?>
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="errors">
                    <?php if ( $this->errors ):  ?>

                        <ul>

                            <?php  foreach ( $this->errors as $error ): ?>

                                <li><?= $error ?></li>

                            <?php endforeach; ?>
                        </ul>

                    <?php endif; ?>
                </div>


                <div class="row">
                    <div class="col-lg-6">
                        <form method="post" action="#">
                            <div class="form-group">
                                <label for="username"><?= USERNAME ?></label>
                                <input type="text" class="form-control" name="username" placeholder="<?= USERNAME ?>" required>
                            </div>


                            <div class="form-group form-captcha">
                                <label for="captcha"><?= CAPTCHA ?></label>
                                <img class="captcha" id="captcha" src="/Modules/Captcha/Captcha.php"><br><br><br>
                                <input type="text" class="form-control" name="captcha" placeholder="<?= ENTER_CAPTCHA ?>" required>
                            </div>

                            <input type="submit" class="btn btn-outline-success" name="forgot" value="<?= FORGOT_PASSWORD ?>">
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

<?php require_once ROOT . '/Views/layouts/footer.php'; ?>