<?php include_once ROOT . '/Views/layouts/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-outline-primary" href="/manager/users/">Адміністрування користувачів</a>

                <hr>
                <table class="table table-bordered">

                        <tr>

                            <td>id</td>
                            <td><?= EMAIL ?></td>
                            <td><?= USERNAME ?></td>
                            <td><?= DATE ?></td>
                            <td><?= STATUS ?></td>

                        </tr>

                        <tr>

                            <td><?= $user['user_id'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['join_date'] ?></td>
                            <td><?= $admin->getStatusName( $user['stat_id'] ) ?></td>

                        </tr>

                </table>


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
                        <input type="text" class="form-control" name="username" value="<?= $user['username'] ?>" placeholder="<?= USERNAME ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="email"><?= EMAIL ?></label>
                        <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" placeholder="<?= EMAIL ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="status"><?= STATUS ?></label>
                        <select name="status" class="form-control">

                            <?php foreach ( $statuses as $status ): ?>
                                <option value="<?= $status['stat_id'] ?>" <?= ( $user['stat_id'] == $status['stat_id'])? ' selected ' : '' ?> ><?= $status['stat_title'] ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>


                    <div class="form-group form-captcha">
                        <label for="captcha"><?= CAPTCHA ?></label>
                        <img class="captcha" id="captcha" src="/Modules/Captcha/Captcha.php"><br><br><br>
                        <input type="text" class="form-control" name="captcha" placeholder="<?= ENTER_CAPTCHA ?>" required>
                    </div>
                    <input type="submit" class="btn btn-outline-success" name="manage" value="<?= MANAGE ?>">
                </form>


            </div>
        </div>
    </div>

<?php include_once ROOT . '/Views/layouts/footer.php'; ?>