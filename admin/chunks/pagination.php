<?php
$ret_pg = mysqli_query($koneksi, $query);
$jum_dt = mysqli_num_rows($ret_pg);
$jum_pg = ceil($jum_dt / $batas);
$srcpg = !empty($search) ? "search=$search&" : "";
?>
<div class="card-footer d-flex align-items-center">
    <ul class="pagination m-0 ms-auto">
        <?php
        if ($jum_pg == 1) {
        ?>
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <polyline points="15 6 9 12 15 18" />
                    </svg>
                </a>
            </li>
            <li class="page-item active"><a class="page-link">1</a></li>
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <polyline points="9 6 15 12 9 18" />
                    </svg>
                </a>
            </li>
            <?php
        } else if ($jum_pg > 1) {
            $prev = $page - 1;
            $next = $page + 1;

            if ($page != 1) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?i=<?= $incl ?>&<?= $srcpg ?>page=1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="11 7 6 12 11 17" />
                            <polyline points="17 7 12 12 17 17" />
                        </svg>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="index.php?i=<?= $incl ?>&<?= $srcpg ?>page=<?= $prev ?>" tabindex="-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="15 6 9 12 15 18" />
                        </svg>
                    </a>
                </li>
            <?php
            }

            for ($i = 1; $i <= $jum_pg; $i++) {
                if ($i != $page) {
                    echo "<li class='page-item'><a class='page-link' href='index.php?i=$incl&" . $srcpg . "page=$i'>$i</a></li>";
                } else {
                    echo "<li class='page-item active'><a class='page-link'>$i</a></li>";
                }
            }

            if ($page != $jum_pg) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?i=<?= $incl ?>&<?= $srcpg ?>page=<?= $next ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="9 6 15 12 9 18" />
                        </svg>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="index.php?i=<?= $incl ?>&<?= $srcpg ?>page=<?= $jum_pg ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="7 7 12 12 7 17" />
                            <polyline points="13 7 18 12 13 17" />
                        </svg>
                    </a>
                </li>
        <?php
            }
        }
        ?>
    </ul>
</div>