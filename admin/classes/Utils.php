<?php
class Utils {
    public static function fileExtension($s) {
        $n = strrpos($s,".");
        return ($n===false) ? "" : substr($s,$n+1);
    }
}
?>