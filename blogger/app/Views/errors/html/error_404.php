<?php $colorCode = "#0494b1";
if (!empty($generalSettings)):
    $colorCode = $generalSettings->site_color;
endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>404 Page Not Found</title>
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>">
    <style>
        html {
            height: 100%;
        }

        body {
            min-height: 100%;
            background-color: #f4f4f4;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        .error-404 {
            display: block;
            width: 100%;
            height: auto;
            text-align: center;
            position: relative;
            top: -100px;
        }

        .error-404 h1 {
            font-size: 164px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 0;
            color: #333;
            letter-spacing: 15px;
        }

        .error-404 h2 {
            margin-top: 10px;
            font-size: 36px;
            color: #333;
        }

        p {
            margin-top: 10px;
            font-size: 14px;
            color: #777;
        }

        .btn-default {
            background-color: <?= $colorCode; ?> !important;
            border-color: <?= $colorCode; ?> !important;
            color: #fff !important;
            border-radius: 2px;
            margin-top: 30px;
            font-size: 14px;
        }

        .btn-default:hover {
            opacity: 0.8;
        }
    </style>
    <?php if (!empty($darkMode) && $darkMode == 1): ?>
        <style>
            body {
                background-color: #1c1c1c;
            }

            .error-404 h1 {
                color: #eee;
            }

            .error-404 h2 {
                color: #eee;
            }

            p {
                margin-top: 10px;
                font-size: 14px;
                color: #eee;
            }
        </style>
    <?php endif; ?>
</head>
<body>

<div class="content">
    <div class="error-404">
        <h1>404</h1>
        <h2><?= trans("page_not_found"); ?></h2>
        <p class="m-b-15"><?= trans("page_not_found_sub"); ?></p>
        <a class="btn btn-lg btn-default" href="<?= langBaseUrl(); ?>"><?= trans("go_to_home"); ?></a>
    </div>
</div>


</body>
</html>
