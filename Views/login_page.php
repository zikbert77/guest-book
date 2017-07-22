<?php require_once ROOT . '/Views/layouts/header.php'; ?>
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-lg-6">
                        <form method="post" action="#">
                            <div class="form-group">
                                <label for="username">Ім'я користувача</label>
                                <input type="text" class="form-control" name="username" placeholder="username" required>
                            </div>

                            <div class="form-group">
                                <label for="pass">Пароль</label>
                                <input type="password" class="form-control" name="pass" required>
                            </div>

                            <div class="form-group form-captcha">
                                <label for="captcha">Капча</label>
                                <img class="captcha" id="captcha" src="/Modules/Captcha/Captcha.php"><br><br><br>
                                <input type="text" class="form-control" name="captcha" placeholder="Введіть капчу" required>
                            </div>
                            <input type="submit" class="btn btn-outline-success" name="login" value="Увійти">
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

<?php require_once ROOT . '/Views/layouts/footer.php'; ?>