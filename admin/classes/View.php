<?php
class View {
    public static function createAlert($code, $msg) {
        $code = strtolower($code);
        switch ($code) {
            case 'd':
                $result =
                "<div class='alert alert-important alert-danger alert-dismissible' role='alert'>\n".$msg."\n<a class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='close'></a>\n</div>";
                break;

            case 's':
                $result =
                "<div class='alert alert-important alert-success alert-dismissible' role='alert'>\n".$msg."\n<a class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='close'></a>\n</div>";
                break;
            
            default:
                $result = "";
                break;
        }
        return $result;
    }
}
?>