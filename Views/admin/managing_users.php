<?php include_once ROOT . '/Views/layouts/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-outline-primary" href="/manager/users/"><?= MANAGE_USERS ?></a>

                <hr>
                <table class="table table-bordered">

                    <tr>
                        <td>id</td>
                        <td><?= EMAIL ?></td>
                        <td><?= USERNAME ?></td>
                        <td><?= DATE ?></td>
                        <td><?= STATUS ?></td>
                        <td><?= ACTION ?></td>
                    </tr>

                    <?php foreach ( $users as $user ): ?>

                        <tr>

                            <td><?= $user['user_id'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['join_date'] ?></td>
                            <td><?= $admin->getStatusName( $user['stat_id'] ) ?></td>
                            <td><a href="<?= '/manage-user/' . $user['user_id'] . '/' ?>"><?= MANAGE ?></a></td>

                        </tr>

                    <?php endforeach; ?>

                </table>

            </div>
        </div>
    </div>

<?php include_once ROOT . '/Views/layouts/footer.php'; ?>