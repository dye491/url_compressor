<?php
/**
 * @var array $vars
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $vars['title'] ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="../../../web/css/style.css">

    <script src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
<div class="panel panel-primary panel-form">
    <div class="panel-heading"><?= $vars['title'] ?></div>
    <div class="panel-body">
        <div class="row">
            <form class="form-inline col-md-12" action="" method="post">
                <div class="row">
                    <input type="hidden" id="csrf" name="csrf_token" value="<?= $vars['csrf_token'] ?>">
                    <label for="source-url" class="col-md-1 ">Source URL</label>
                    <div class="col-md-4">
                        <input id="source-url" type="text" name="url" value="http://">
                        <?php if ($vars['error']): ?>
                            <span style="color: red"><?= $vars['error'] ?></span>
                        <?php endif; ?>
                    </div>
                    <label for="redirect_url" class="col-md-1">Redirect URL (optional)</label>
                    <div class="col-md-4">
                        <input type="text" id="redirect_url" name="redirect_url"
                               placeholder="something like http://<?= $_SERVER['HTTP_HOST'] ?>/?h=bla-bla-bla">
                    </div>
                    <div class="col-md-2">
                        <input id="btn-send" type="button" value="Compress this URL">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="panel panel-default panel-result">
    <!--    --><?php //if (isset($vars['short_url'])): ?>
    <div class="panel-heading">Compressed URL</div>
    <div class="panel-body">
        <p>
            <a href="<?= $vars['short_url'] ?>" target="_blank"><?= $vars['short_url'] ?></a>
        </p>
    </div>
    <!--    --><?php //endif; ?>
</div>
<script src="js/script.js"></script>
</body>
</html>