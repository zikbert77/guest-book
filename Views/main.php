<?php include_once ROOT . '/Views/layouts/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-outline-primary" href="/add-message/"><?= WRITE_MESSAGE ?></a>
                <br><br>
                <table class="table table-bordered">
                    <tr>
                        <td><a href="<?= ( $sort == 'username_asc' )? "/page-$page/username_desc/" : "/page-$page/username_asc/"  ?>"><?= USERNAME ?></a></td>
                        <td><a href="<?= ( $sort == 'email_asc' )? "/page-$page/email_desc/" : "/page-$page/email_asc/"  ?>"><?= EMAIL ?></a></td>
                        <td><?= HOMEPAGE ?></td>
                        <td><?= MESSAGE ?></td>
                        <td><?= IMG ?></td>
                        <td><a href="<?= ( $sort == 'date_asc' )? "/page-$page/date_desc/" : "/page-$page/date_asc/"  ?>"><?= DATE ?></a></td>
                    </tr>

                    <?php foreach ( $msgs as $msg ): ?>
                        <tr>
                            <td><?= $msg['user_name'] ?></td>
                            <td><?= $msg['user_email'] ?></td>
                            <td><?= $msg['homepage'] ?></td>
                            <td><?= $msg['text'] ?></td>
                            <td><img width="160" height="120" src="/msgs/<?= $msg['id'] . '/' . $msg['picture'] ?>"></td>
                            <td><?= $msg['date'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <div class="paginations">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <hr>
                            <nav aria-label="Page navigation">
                                <?= $pagination->get() ?>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php include_once ROOT . '/Views/layouts/footer.php'; ?>