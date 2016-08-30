<?php
session_start(); // 세션 시작
session_destroy(); // 세션 파괴!!
header('location: login'); // /login 페이지로 가라
