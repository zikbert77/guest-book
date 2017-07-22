<?php include_once ROOT . '/Views/layouts/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-outline-primary" href="/add-message">Залишити повідомлення</a>
                <br><br>
                <table class="table table-bordered">
                    <tr>
                        <td><a href="#">Ім'я користувача</a></td>
                        <td><a href="#">Електронна адреса</a></td>
                        <td><a href="#">Домашня сторінка</a></td>
                        <td><a href="#">Повідомлення</a></td>
                        <td><a href="#">Дата</a></td>
                    </tr>

                    <?php foreach ( $msgs as $msg ): ?>
                        <tr>
                            <td><?= $msg['user_name'] ?></td>
                            <td><?= $msg['user_email'] ?></td>
                            <td><?= $msg['homepage'] ?></td>
                            <td><?= $msg['text'] ?></td>
                            <td><?= $msg['date'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <div class="pagination">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>

<?php include_once ROOT . '/Views/layouts/footer.php'; ?>