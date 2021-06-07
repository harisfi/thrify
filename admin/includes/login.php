<div class="page page-center">
    <div class="container-tight py-4">
        <form action="./handlers/login.php" method="POST" class="card card-md">
            <div class="card-head text-center bg-dark rounded-top py-3">
                <h1 class="text-light mb-0">Login</h1>
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET['m'])) {
                    $err = explode("-", $_GET['m']);
                    if ($err[0] == "d") {
                        switch ($err[1]) {
                            case 1:
                                echo View::createAlert($err[0], "Maaf, username tidak boleh kosong!");
                                break;
                            case 2:
                                echo View::createAlert($err[0], "Maaf, password tidak boleh kosong!");
                                break;
                            case 3:
                                echo View::createAlert($err[0], "Maaf, username/password tidak ditemukan!");
                                break;
                            default:
                                break;
                        }
                    }
                }
                ?>
                <div class="mb-3">
                    <label class="form-label required">Username</label>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="12" cy="7" r="4" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                        </span>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Password</label>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <!-- Download SVG icon from http://tabler-icons.io/i/lock -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <rect x="5" y="11" width="14" height="10" rx="2" />
                                <circle cx="12" cy="16" r="1" />
                                <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                            </svg>
                        </span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" name="login" value="login" class="btn px-5 btn-primary">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>