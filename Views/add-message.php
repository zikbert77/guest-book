<?php require_once ROOT . '/Views/layouts/header.php'; ?>

<?php if ( isset( $_SESSION['user_id'] ) ): ?>

    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-lg-6">


                        <div class="preview">

                            <h2>Попередній перегляд</h2>

                            <table class="table table-bordered">
                                <tr>
                                    <td>Ім'я користувача</td>
                                    <td>Електронна адреса</td>
                                    <td>Домашня сторінка</td>
                                    <td>Повідомлення</td>
                                </tr>
                                <tr>
                                    <td id="p_username"></td>
                                    <td id="p_email"></td>
                                    <td id="p_homepage"></td>
                                    <td id="p_text"></td>
                                </tr>
                            </table>

                            <hr>

                        </div>

                        <?php if ( !isset( $success ) ): ?>

                            <form method="post" action="#">
                                <div class="form-group">
                                    <label for="username">Ім'я користувача</label>
                                    <input type="text" id="username" class="form-control" name="username" <?= ($user['username'])? 'value="'. $user['username'] .'" readonly ' : ' required' ?> placeholder="username">
                                </div>
                                <div class="form-group">
                                    <label for="email">Електронна адреса</label>
                                    <input type="email" id="email" class="form-control" name="email"  <?= ($user['email'])? 'value="'. $user['email'] .'" readonly ' : ' required' ?> placeholder="email">
                                </div>
                                <div class="form-group">
                                    <label for="url">Homepage</label>
                                    <input type="url" class="form-control" id="homepage" name="url" placeholder="Homepage">
                                </div>
                                <div class="form-group">
                                    <label for="text">Повідомлення</label>
                                    <span class="text-editing"> [link], [italic], [strike], [strong] </span>
                                    <textarea name="text" class="form-control" id="text" cols="30" rows="10" required></textarea>
                                </div>
                                <div class="form-group form-captcha">
                                    <label for="captcha">Капча</label>
                                    <img class="captcha" id="captcha" src="/Modules/Captcha/Captcha.php" title="Змінити зображення" alt="Капча"><br><br><br>
                                    <input type="text" class="form-control" name="captcha" placeholder="Введіть капчу" required>
                                </div>
                                <input type="submit" class="btn btn-outline-success" name="add-message" value="Добавити повідомлення">
                                <button id="preview-btn" class="btn btn-outline-info">Попередній перегляд</button>
                            </form>
                        <?php else: ?>
                            <h1><?= $success ?></h1>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>

    </div>
<?php else: ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Для додавання повідомлення ви повинні <a href="/login">увійти в аккаунт</a> або <a href="/register">зареєструватися</a></h1>
            </div>
        </div>
    </div>
<?php endif; ?>


<script>

    $(".preview").hide();

    $(document).ready(function () {
        
        $("#preview-btn").click( function () {

            $(".preview").show();

            var user_name = $("#username").val();
            var email     = $("#email").val();
            var homepage  = $("#homepage").val();
            var text      = $("#text").val();

            $("#p_username").html(user_name);
            $("#p_email").html(email);
            $("#p_homepage").html(homepage);
            $("#p_text").html(text);
        })

    });

</script>


<?php require_once ROOT . '/Views/layouts/footer.php'; ?>