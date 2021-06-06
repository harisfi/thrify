<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
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
                    for ($i = 0; $i < 30; $i++) {
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
                for ($i = 0; $i < 30; $i++) {
                    array_push($arr, "'" . date("Y-m-d", strtotime(date("Y/m/d") . "-$i days")) . "'");
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
    document.addEventListener("DOMContentLoaded", function() {
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
                    for ($i = 0; $i < 30; $i++) {
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
                for ($i = 0; $i < 30; $i++) {
                    array_push($arr, "'" . date("Y-m-d", strtotime(date("Y/m/d") . "-$i days")) . "'");
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
    document.addEventListener("DOMContentLoaded", function() {
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
                    for ($i = 0; $i < 30; $i++) {
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
                for ($i = 0; $i < 30; $i++) {
                    array_push($arr, "'" . date("Y-m-d", strtotime(date("Y/m/d") . "-$i days")) . "'");
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