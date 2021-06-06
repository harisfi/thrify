<?php
session_start();
include("../koneksi/koneksi.php");
include("./classes/Utils.php");
include("./classes/View.php");

$incl = $_GET['i'];

include("./handlers/auth.php");

if (!empty($incl)) {
    $pageTitle = ucwords(str_replace("z", " ", implode(" ", array_reverse(explode("-", $incl)))));
} else {
    $pageTitle = "Dashboard";
}

$incl = str_replace("z", "", $incl);

if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else if ($_POST['search']) {
    $search = $_POST['search'];
} else {
    $search = NULL;
}

$batas = 8;
if (!isset($_GET['page'])) {
    $pos = 0;
    $page = 1;
} else {
    $page = $_GET['page'];
    $pos = ($page - 1) * $batas;
}
?>

<!doctype html>
<html lang="en">
<?php include("./chunks/head.php") ?>

<body class="antialiased<?= $incl == 'login' ? ' d-flex flex-column' : '' ?>">
    <?php
    if ($incl == 'login') {
        include("./includes/login.php");
    } else {
        echo "<div class='wrapper'>";
        include("./chunks/sidebar.php");
        echo "<div class='page-wrapper'>";
        if (!empty($incl) && file_exists("./includes/$incl.php")) {
            include("./includes/$incl.php");
        } else {
            include("./includes/dashboard.php");
        }
        include("./chunks/footer.php");
        echo "</div></div>";
    } ?>
    <!-- Libs JS -->
    <script src="./dist/libs/apexcharts/dist/apexcharts.min.js"></script>
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js"></script>
    <?php
    if ($incl == 'dashboard' || empty($incl) || !file_exists("./includes/$incl.php")) {
        include("./chunks/charts.php");
    }
    ?>
</body>

</html>