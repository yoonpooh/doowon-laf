<?php
session_start(); // 세션 시작
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>두원공과대학교 분실물센터</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<header class="container">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">두원공과대학교 분실물센터</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li id="home"><a href="/">홈</a></li>
                    <li id="write"><a href="write">글쓰기</a></li>
                    <?php
                    if (empty($_SESSION["id"])) {
                        ?>
                        <li id="join"><a href="join">회원가입</a></li>
                        <li id="login"><a href="login">로그인</a></li>
                        <?php
                    } else {
                        ?>
                        <li id="mypage"><a href="mypage"><?php echo $_SESSION["username"]; ?></a></li>
                        <li id="logout"><a href="logout">로그아웃</a></li>
                        <?php
                    }
                    ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>