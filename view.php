<?php
include 'templates/header.php';

$no = $_GET['no'];

include "config/database.php";

$sql = "SELECT * FROM contents INNER JOIN users ON contents.id = users.id WHERE no = $no";
$list = $conn->query($sql);

while ($row = $list->fetch_assoc()) {
    ?>
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="wrap">
                <?php
                if ($_SESSION['id'] == $row["id"] || $_SESSION['id'] == "admin") {
                    ?>
                    <button type="button" onclick="delete_content(<?php echo $row["no"] ?>)" class="close"
                            aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <?php
                }
                ?>
                <
                h2 ><?php echo $row['title'] ?></h2>
                <h4><?php echo $row['type'] ?> - <?php echo $row['location'] ?></h4>
                <hr>
                <pre><?php echo $row['content'] ?></pre>
                <?php
                if ($row['url'] != 'none') {
                    ?>
                    <img class="img-responsive" src="<?php echo $row['url'] ?>" alt="">
                    <?php
                }
                ?>
                <hr>
                <?php echo $row['username'] ?> - <?php echo $row['datetime'] ?>
            </div>
        </div>
    </div>
    <?php
}
include 'templates/footer.php';

