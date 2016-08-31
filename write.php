<?php
include 'templates/header.php';

if (empty($_SESSION['id'])) { // 세션 id 가 없으면 로그인페이지로
    echo "<script>alert('로그인을 해주세요.'); location.href = 'login'</script>";
}

$type = $_POST['type'];
$title = $_POST['title'];
$location = $_POST['location'];
$content = $_POST['content'];
$image = $_FILES['image'];

if (isset($type) && isset($title) && isset($location) && isset($content)) {
    include 'config/database.php';

    $stmt = $conn->prepare("INSERT INTO contents (id, type, title, location, content, url) VALUES (?, ?, ?, ?, ?, ?)");

    if ($image['name'] == '') { // 이미지 파일이 없을 경우
        $stmt->bind_param("ssssss", $_SESSION['id'], $type, $title, $location, $content, 'none');
    } else { // 있을경우 imgur api 를 이용하여 이미지 업로드
        $filename = $image['tmp_name'];
        $client_id = "b82df6181b7070b";
        $handle = fopen($filename, "r");
        $data = fread($handle, filesize($filename));
        $pvars = array('image' => base64_encode($data));
        $timeout = 30;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
        $out = curl_exec($curl);
        curl_close($curl);
        $pms = json_decode($out, true);
        $url = $pms['data']['link'];

        $stmt->bind_param("ssssss", $_SESSION['id'], $type, $title, $location, $content, $url);
    }

    $stmt->execute();
    $stmt->close();

    $conn->close();

    echo "<script>alert('글 작성이 완료되었습니다.'); location.href = '/'</script>";
}


?>
    <div class="container">
        <div class="col-md-4 col-md-offset-4 wrap">
            <h1>글쓰기</h1>
            <hr>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="type">유형</label>
                    <select class="form-control" name="type" id="">
                        <option value="lost">분실</option>
                        <option value="found">습득</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">제목</label>
                    <input name="title" class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="location">위치</label>
                    <input name="location" class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="content">내용</label>
                    <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">이미지 (선택)</label>
                    <input name="image" class="form-control" type="file" size="35" accept="image/*">
                </div>
                <hr>
                <div class="text-right">
                    <button type="reset" class="btn btn-warning">다시작성</button>
                    <button class="btn btn-success">작성완료</button>
                </div>
            </form>
        </div>
    </div>
<?php
include 'templates/footer.php';
