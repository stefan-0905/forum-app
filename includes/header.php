<?php
ob_start();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Forum App <?php if(isset($site_title)) echo "- " . $site_title; ?></title>
    <link rel="shortcut icon" href="img/bitnami.ico"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <!-- Include Editor style. -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_style.min.css' rel='stylesheet' type='text/css' />
    
</head>
<body>