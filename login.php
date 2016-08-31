<?php
include "templates/header.php"; // header 파일

if (isset($_SESSION['id'])) { // 세션 id 가 있으면 메인페이지로
    header('Location: /');
}

$id = $_POST['id'];
$password = $_POST['password']; // post 값 받아오기

if (isset($id) && isset($password)) { // 존재 할 경우
    include 'config/database.php';

    $sql = "SELECT username FROM users WHERE id = '$id' and password = password('$password')";
    $username = $conn->query($sql)->fetch_object()->username; // 쿼리를 돌려서 username 받아오기

    if (empty($username)) { // 없으면
        echo "<script>alert('로그인 정보가 올바르지 않습니다.');location.href = 'login'</script>";
    } else { // 있으면
        $_SESSION['username'] = $username; // 세션 username에 $username 넣기
        $_SESSION["id"] = $id; // id 넣기
        echo "<script>alert('로그인이 완료되었습니다.');location.href = '/'</script>";
    }

    $conn->close();
}
?>
    <div class="container">
        <div class="col-md-4 col-md-offset-4 wrap">
            <h1>로그인</h1>
            <hr>
            <form method="post">
                <div class="form-group">
                    <label for="id">아이디</label>
                    <input name="id" class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="password">비밀번호</label>
                    <input name="password" class="form-control" type="password">
                </div>
                <hr>
                <div class="text-right">
                    <button class="btn btn-info" type="button" onclick="location.href = 'reset'">비밀번호 찾기</button>
                    <button class="btn btn-success" type="button" onclick="location.href = 'join'">회원가입</button>
                    <button class="btn btn-primary">로그인</button>
                </div>
            </form>
        </div>
    </div>
<?php
include "templates/footer.php"; // footer 파일
