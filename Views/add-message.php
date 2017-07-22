<?php require_once ROOT . '/Views/layouts/header.php'; ?>
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-lg-6">
                        <form>
                            <div class="form-group">
                                <label for="username">Ім'я користувача</label>
                                <input type="text" class="form-control" name="username" placeholder="username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Електронна адреса</label>
                                <input type="email" class="form-control" name="email" placeholder="email" required>
                            </div>
                            <div class="form-group">
                                <label for="url">Homepage</label>
                                <input type="url" class="form-control" name="url" placeholder="Homepage">
                            </div>
                            <div class="form-group">
                                <label for="text">Повідомлення</label>
                                <span class="text-editing"> [link], [italic], [strike], [strong] </span>
                                <textarea name="text" class="form-control" id="text" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group form-captcha">
                                <label for="captcha">Капча</label>
                                <img class="captcha" id="captcha" src="/Modules/Captcha/Captcha.php"><br><br><br>
                                <input type="text" class="form-control" name="captcha" placeholder="Введіть капчу" required>
                            </div>
                            <input type="submit" class="btn btn-outline-success" name="add-message" value="Добавити повідомлення">
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>



<?php require_once ROOT . '/Views/layouts/footer.php'; ?>