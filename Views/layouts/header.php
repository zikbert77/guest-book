<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Bootstrap 4-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?= '/Resources/Stylesheet/style.css' ?>">
    <title>Guest-book</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>
                <br>
                    <span class="title"><b>GuestBook</b></span>
                    <span class="user-panel">

                        <?php if ( isset($_SESSION['user_id']) ): ?>
                            <a href="/logout"><?= LOGOUT ?></a> &nbsp;
                            <a href="/user/<?= $_SESSION['user_id'] ?>"><?= $_SESSION['user_name'] ?></a>
                        <?php else: ?>
                            <a href="/login"><?= LOGIN ?></a> &nbsp;
                            <a href="/register"><?= REGISTER ?></a>
                        <?php endif; ?>
                    </span>

                    <form class="inline-form">
                        <select name="lang" id="lang">
                            <?php

                            $allLangs = \Models\Tech::getAllLangs();


                            foreach ($allLangs as $lang) {
                                $same = '';
                                if ( $lang['lang_id'] == $_SESSION['lang'] )
                                    $same = ' selected ';

                                echo "<option value=\"{$lang['lang_id']}\" $same >{$lang['lang_title']}</option>";

                            }

                            ?>
                        </select>
                    </form>


            </p>
            <hr>
        </div>
    </div>
</div>