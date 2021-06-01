<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <img src="./static/logo-white.svg" width="110" height="32" alt="Thrify" class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div><?= $_SESSION['nama_admin'] ?></div>
                        <div class="mt-1 small text-muted"><?= ucfirst($_SESSION['tipe_admin']) ?></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="./akun.php" class="dropdown-item">Akun</a>
                    <a href="./signout.php" class="dropdown-item">Log Out</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item <?= $pageSeq == 0 ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown <?= ($pageSeq > 0 && $pageSeq < 6) ? 'active' : '' ?>">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" />
                                <line x1="12" y1="12" x2="20" y2="7.5" />
                                <line x1="12" y1="12" x2="12" y2="21" />
                                <line x1="12" y1="12" x2="4" y2="7.5" />
                                <line x1="16" y1="5.25" x2="8" y2="9.75" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Data Master
                        </span>
                    </a>
                    <div class="dropdown-menu <?= ($pageSeq > 0 && $pageSeq < 6) ? 'show' : '' ?>">
                        <a class="dropdown-item <?= $pageSeq == 1 ? 'active' : '' ?>" href="brandproduk.php">
                            Brand Produk
                        </a>
                        <a class="dropdown-item <?= $pageSeq == 2 ? 'active' : '' ?>" href="kategoriproduk.php">
                            Kategori Produk
                        </a>
                        <a class="dropdown-item <?= $pageSeq == 3 ? 'active' : '' ?>" href="diskonproduk.php">
                            Diskon Produk
                        </a>
                        <a class="dropdown-item <?= $pageSeq == 4 ? 'active' : '' ?>" href="providerpembayaran.php">
                            Provider Pembayaran
                        </a>
                        <a class="dropdown-item <?= $pageSeq == 5 ? 'active' : '' ?>" href="statuspesanan.php">
                            Status Pesanan
                        </a>
                    </div>
                </li>
                <li class="nav-item <?= $pageSeq == 6 ? 'active' : '' ?>">
                    <a class="nav-link" href="pesanan.php">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <polyline points="9 11 12 14 20 6" />
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Pesanan
                        </span>
                    </a>
                </li>
                <li class="nav-item <?= $pageSeq == 7 ? 'active' : '' ?>">
                    <a class="nav-link" href="produk.php">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <rect x="4" y="4" width="6" height="5" rx="2" />
                                <rect x="4" y="13" width="6" height="7" rx="2" />
                                <rect x="14" y="4" width="6" height="7" rx="2" />
                                <rect x="14" y="15" width="6" height="5" rx="2" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Produk
                        </span>
                    </a>
                </li>
                <li class="nav-item <?= $pageSeq == 8 ? 'active' : '' ?>">
                    <a class="nav-link" href="user.php">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            User
                        </span>
                    </a>
                </li>
                <?php
                if ($_SESSION['tipe_admin'] == "superadmin") {?>
                <li class="nav-item <?= $pageSeq == 9 ? 'active' : '' ?>">
                    <a class="nav-link" href="admin.php">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 12l2 2l4 -4" />
                                <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Admin
                        </span>
                    </a>
                </li>
                <?php } ?>
                <li class="nav-item <?= $pageSeq == 10 ? 'active' : '' ?>">
                    <a class="nav-link" href="akun.php">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="12" cy="12" r="9" />
                                <path d="M10 16.5l2 -3l2 3m-2 -3v-2l3 -1m-6 0l3 1" />
                                <circle cx="12" cy="7.5" r=".5" fill="currentColor" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Akun
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signout.php">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 12h14l-3 -3m0 6l3 -3" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Log Out
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div><?= $_SESSION['nama_admin'] ?></div>
                        <div class="mt-1 small text-muted"><?= ucfirst($_SESSION['tipe_admin']) ?></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="./akun.php" class="dropdown-item">Akun</a>
                    <a href="./signout.php" class="dropdown-item">Log Out</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="h2 mb-0 text-dark">Welcome, <?= explode(" ", $_SESSION['nama_admin'])[0] ?>!</div>
        </div>
    </div>
</header>