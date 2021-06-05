<?php
class Utils {
    public static function fileExtension($s) {
        $n = strrpos($s,".");
        return ($n===false) ? "" : substr($s,$n+1);
    }

    public static function formatNumber($n) {
        if ($n < 1000000) {
            $n_format = number_format($n);
        } else if ($n < 1000000000) {
            $n_format = number_format($n / 1000000, 1) . 'M';
        } else {
            $n_format = number_format($n / 1000000000, 1) . 'B';
        }
        return $n_format;
    }
}
?>