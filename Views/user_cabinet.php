<?php include_once ROOT . '/Views/layouts/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">

                <h1><?= $_SESSION['user_name'] ?></h1>

            </div>

            <div class="col-lg-6">

                <form action="#" method="post">
                    <div class="form-group">
                        <label for="change_lang"><?= CHANGE_LANG ?></label>
                        <select name="change_lang" id="change_lang" class="form-control">
                            <?php

                            $allLangs = \Models\Tech::getAllLangs();


                            foreach ($allLangs as $lang) {

                                echo "<option value=\"{$lang['lang_id']}\">{$lang['lang_title']}</option>";

                            }

                            ?>
                        </select>
                    </div>
                    <button type="submit" name="change" class="btn btn-deffault"><?= CHANGE ?></button>
                </form>

            </div>

        </div>
    </div>

<?php include_once ROOT . '/Views/layouts/footer.php'; ?>