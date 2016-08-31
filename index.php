<?php
include "templates/header.php"; // header 파일
?>
    <div class="container">
        <div class="col-md-6 col-md-offset-3" align="center">
            <select class="input-lg" id="type">
                <option value="">전체</option>
                <option value="분실">분실</option>
                <option value="습득">습득</option>
            </select>
            <input class="input-lg" type="text" id="keyword">
        </div>
        <div id="list">
            <?php include 'config/list.php' ?>
        </div>
    </div>
<?php
include "templates/footer.php"; // footer 파일