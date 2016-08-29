<?php
include "templates/header.php"; // header 파일

if (isset($_SESSION['id'])) {
    header('Location: /');
}

$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];

if (isset($id) && isset($username) && isset($password)) {
    include "config/database.php";

    $stmt = $conn->prepare("INSERT INTO users VALUES (?, ?, password(?))");
    $stmt->bind_param("sss", $id, $username, $password);
    $stmt->execute();
    $stmt->close();

    $conn->close();

    echo "<script>alert('회원가입이 완료되었습니다.'); location.href = '/'</script>";
}
?>
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <h1>회원가입</h1>
            <hr>
            <form method="post">
                <div id="div-id" class="form-group has-feedback">
                    <label for="id">아이디</label>
                    <input name="id" class="form-control" id="join-id" type="text">
                    <span id="span-id" class="form-control-feedback"></span>
                </div>
                <div id="div-username" class="form-group has-feedback">
                    <label for="username">이름</label>
                    <input name="username" class="form-control" id="join-username" type="text">
                    <span id="span-username" class="form-control-feedback"></span>
                </div>
                <div id="div-password" class="form-group has-feedback">
                    <label for="password">비밀번호</label>
                    <input name="password" class="form-control" id="join-password" type="password">
                    <span id="span-password" class="form-control-feedback"></span>
                </div>
                <hr>
                <div class="text-right">
                    <button class="btn btn-success">회원가입</button>
                </div>
            </form>
        </div>
    </div>
<?php
include "templates/footer.php"; // footer 파일