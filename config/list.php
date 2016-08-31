<?php
session_start();

$type = $_POST['type'];
$keyword = $_POST["keyword"];

include "database.php";

$sql = "SELECT * FROM contents INNER JOIN users ON contents.id = users.id WHERE type like '%$type%' AND (title LIKE '%$keyword%' OR location LIKE '%$keyword%' OR content LIKE '%$keyword%') ORDER BY no DESC";
$list = $conn->query($sql);

while ($row = $list->fetch_assoc()) {
    ?>
    <div class="col-md-6">
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
            <a href="view?no=<?php echo $row['no'] ?>">
                <h2><?php echo $row['title'] ?></h2>
                <hr>
                <h4><?php echo $row['type'] ?> - <?php echo $row['location'] ?></h4>
                <?php echo $row['username'] ?> - <?php echo $row['datetime'] ?>
            </a>
        </div>
    </div>
    <?php
}