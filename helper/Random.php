<?php
    function random($code, $length){
        $numbers = "0123456789";
        $mix = str_shuffle($numbers);
        $result = $code . "-" . substr($mix, 0, $length);

        return $result;
    }
?>