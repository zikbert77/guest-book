<?php require_once ROOT . '/Views/layouts/header.php'; ?>

<?php if ( isset( $_SESSION['user_id'] ) ): ?>

    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-lg-5">

                        <?php if ( !isset( $success ) ): ?>

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
                                    <label for="username"><?= USERNAME ?></label>
                                    <input type="text" id="username" class="form-control" name="username" <?= ($user['username'])? 'value="'. $user['username'] .'" readonly ' : ' required' ?> placeholder="<?= USERNAME ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email"><?= EMAIL ?></label>
                                    <input type="email" id="email" class="form-control" name="email"  <?= ($user['email'])? 'value="'. $user['email'] .'" readonly ' : ' required' ?> placeholder="<?= EMAIL ?>">
                                </div>
                                <div class="form-group">
                                    <label for="url"><?= HOMEPAGE ?></label>
                                    <input type="url" class="form-control" id="homepage" name="url" value="<?= isset( $msg['homepage'] )? $msg['homepage'] : '' ?>" placeholder="<?= HOMEPAGE ?>">
                                </div>
                                <div class="form-group">
                                    <label for="text"><?= MESSAGE ?></label>

                                    <textarea name="text" class="form-control" id="text" cols="30" rows="10" required><?= isset( $msg['text'] )? $msg['text'] : '' ?></textarea>
                                </div>
                                <div class="form-group form-captcha">
                                    <label for="captcha"><?= CAPTCHA ?></label>
                                    <img class="captcha" id="captcha" src="/Modules/Captcha/Captcha.php" title="<?= CHANGE_CAPTCHA ?>" alt="Капча"><br><br><br>
                                    <input type="text" class="form-control" name="captcha" placeholder="<?= ENTER_CAPTCHA ?>" required>
                                </div>
                                <input type="submit" class="btn btn-outline-success" name="add-message" value="<?= ADD_MESSAGE ?>">
                                <button id="preview-btn" class="btn btn-outline-info"><?= PREVIEW ?></button>
                            </form>
                        <?php else: ?>
                            <h1><?= $success ?></h1>
                        <?php endif; ?>

                    </div>
                    <div class="col-lg-7">
                        <div class="preview">

                            <h2><?= PREVIEW ?></h2>

                            <table class="table table-bordered">
                                <tr>
                                    <td><?= USERNAME ?></td>
                                    <td><?= EMAIL ?></td>
                                    <td><?= HOMEPAGE ?></td>
                                    <td><?= MESSAGE ?></td>
                                </tr>
                                <tr>
                                    <td id="p_username"></td>
                                    <td id="p_email"></td>
                                    <td id="p_homepage"></td>
                                    <td id="p_text"></td>
                                </tr>
                            </table>


                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
<?php else: ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1><?= MUST_LOGIN_OR_REGISTER ?></h1>
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