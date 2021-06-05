<?php
session_start();
include("./classes/Utils.php");
$pageTitle = "Dashboard";
$pageSeq = 0;
?>
<!doctype html>
<html lang="en">
  <?php include("./chunks/head.php") ?>
  <body class="antialiased">
    <div class="wrapper">
      <?php include("./chunks/sidebar.php") ?>
      <div class="page-wrapper">
        <div class="container-fluid">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title">
                  Dashboard
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Transaksi</div>
                      <div class="ms-auto lh-1">
                        <span class="text-muted">Last 30 days</span>
                      </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-0 me-2">Rp <?= Utils::formatNumber(rand()) ?></div>
                      <div class="me-auto">
                        <span class="text-green d-inline-flex align-items-center lh-1">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="3 17 9 11 13 15 21 7" /><polyline points="14 7 21 7 21 14" /></svg>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div id="chart-revenue-bg" class="chart-sm"></div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Client baru</div>
                      <div class="ms-auto lh-1">
                        <span class="text-muted">Last 30 days</span>
                      </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-3 me-2"><?= Utils::formatNumber(rand()) ?></div>
                      <div class="me-auto">
                        <span class="text-green d-inline-flex align-items-center lh-1">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="3 17 9 11 13 15 21 7" /><polyline points="14 7 21 7 21 14" /></svg>
                        </span>
                      </div>
                    </div>
                    <div id="chart-new-clients" class="chart-sm"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="row row-cards">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h3 class="card-title">Traffic summary</h3>
                        <div id="chart-mentions" class="chart-lg"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="row row-cards">
                  <div class="col-12">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              <?php $n = rand() ?>
                              <?= Utils::formatNumber($n) ?> Penjualan
                            </div>
                            <div class="text-muted">
                              <?= Utils::formatNumber(rand(0, $n)) ?> menunggu pembayaran
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="6" cy="19" r="2" /><circle cx="17" cy="19" r="2" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              <?php $n = rand() ?>
                              <?= Utils::formatNumber($n) ?> Pesanan
                            </div>
                            <div class="text-muted">
                              <?= Utils::formatNumber(rand(0, $n)) ?> terkirim
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-yellow text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/users -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              <?php $n = rand() ?>
                              <?= Utils::formatNumber($n) ?> Client
                            </div>
                            <div class="text-muted">
                              <?= Utils::formatNumber(rand(0, $n)) ?> mendaftar hari ini
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-dark text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/chart-area-line -->
	                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="4 19 8 13 12 15 16 10 20 14 20 19 4 19" /><polyline points="4 12 7 8 11 10 16 4 20 8" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              <?php $n = rand() ?>
                              <?= Utils::formatNumber($n) ?> Kunjungan
                            </div>
                            <div class="text-muted">
                              <?= Utils::formatNumber(rand(0, $n)) ?> hari ini
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php include("./chunks/footer.php") ?>
      </div>
    </div>
    <!-- Libs JS -->
    <script src="./dist/libs/apexcharts/dist/apexcharts.min.js"></script>
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js"></script>
    <script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
      	window.ApexCharts && (new ApexCharts(document.getElementById('chart-revenue-bg'), {
      		chart: {
      			type: "area",
      			fontFamily: 'inherit',
      			height: 40.0,
      			sparkline: {
      				enabled: true
      			},
      			animations: {
      				enabled: false
      			},
      		},
      		dataLabels: {
      			enabled: false,
      		},
      		fill: {
      			opacity: .16,
      			type: 'solid'
      		},
      		stroke: {
      			width: 2,
      			lineCap: "round",
      			curve: "smooth",
      		},
      		series: [{
      			name: "Transaksi",
      			data: [
              <?php
              $arr = [];
              for ($i=0; $i < 30; $i++) {
                array_push($arr, rand());
              }
              echo implode(", ", $arr);
              ?>
            ]
      		}],
      		grid: {
      			strokeDashArray: 4,
      		},
      		xaxis: {
      			labels: {
      				padding: 0,
      			},
      			tooltip: {
      				enabled: false
      			},
      			axisBorder: {
      				show: false,
      			},
      			type: 'datetime',
      		},
      		yaxis: {
      			labels: {
      				padding: 4
      			},
      		},
      		labels: [
      			<?php
            $arr = [];
            for ($i=0; $i < 30; $i++) {
              array_push($arr, "'".date("Y-m-d", strtotime(date("Y/m/d")."-$i days"))."'");
            }
            echo implode(", ", $arr);
            ?>
      		],
      		colors: ["#206bc4"],
      		legend: {
      			show: false,
      		},
      	})).render();
      });
      // @formatter:on
    </script>
    <script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
      	window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-clients'), {
      		chart: {
      			type: "line",
      			fontFamily: 'inherit',
      			height: 40.0,
      			sparkline: {
      				enabled: true
      			},
      			animations: {
      				enabled: false
      			},
      		},
      		fill: {
      			opacity: 1,
      		},
      		stroke: {
      			width: [2, 1],
      			dashArray: [0, 3],
      			lineCap: "round",
      			curve: "smooth",
      		},
      		series: [{
      			name: "Client",
      			data: [
              <?php
              $arr = [];
              for ($i=0; $i < 30; $i++) {
                array_push($arr, rand());
              }
              echo implode(", ", $arr);
              ?>
            ]
      		}],
      		grid: {
      			strokeDashArray: 4,
      		},
      		xaxis: {
      			labels: {
      				padding: 0,
      			},
      			tooltip: {
      				enabled: false
      			},
      			type: 'datetime',
      		},
      		yaxis: {
      			labels: {
      				padding: 4
      			},
      		},
      		labels: [
      			<?php
            $arr = [];
            for ($i=0; $i < 30; $i++) {
              array_push($arr, "'".date("Y-m-d", strtotime(date("Y/m/d")."-$i days"))."'");
            }
            echo implode(", ", $arr);
            ?>
      		],
      		colors: ["#206bc4", "#a8aeb7"],
      		legend: {
      			show: false,
      		},
      	})).render();
      });
      // @formatter:on
    </script>
    <script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
      	window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
      		chart: {
      			type: "bar",
      			fontFamily: 'inherit',
      			height: 240,
      			parentHeightOffset: 0,
      			toolbar: {
      				show: false,
      			},
      			animations: {
      				enabled: false
      			},
      			stacked: true,
      		},
      		plotOptions: {
      			bar: {
      				columnWidth: '50%',
      			}
      		},
      		dataLabels: {
      			enabled: false,
      		},
      		fill: {
      			opacity: 1,
      		},
      		series: [{
      			name: "Total",
      			data: [
              <?php
              $arr = [];
              for ($i=0; $i < 30; $i++) {
                array_push($arr, rand());
              }
              echo implode(", ", $arr);
              ?>
            ]
      		}],
      		grid: {
      			padding: {
      				top: -20,
      				right: 0,
      				left: -4,
      				bottom: -4
      			},
      			strokeDashArray: 4,
      			xaxis: {
      				lines: {
      					show: true
      				}
      			},
      		},
      		xaxis: {
      			labels: {
      				padding: 0,
      			},
      			tooltip: {
      				enabled: false
      			},
      			axisBorder: {
      				show: false,
      			},
      			type: 'datetime',
      		},
      		yaxis: {
      			labels: {
      				padding: 4
      			},
      		},
      		labels: [
      			<?php
            $arr = [];
            for ($i=0; $i < 30; $i++) {
              array_push($arr, "'".date("Y-m-d", strtotime(date("Y/m/d")."-$i days"))."'");
            }
            echo implode(", ", $arr);
            ?>
      		],
      		colors: ["#206bc4", "#79a6dc", "#bfe399"],
      		legend: {
      			show: false,
      		},
      	})).render();
      });
      // @formatter:on
    </script>
  </body>
</html>