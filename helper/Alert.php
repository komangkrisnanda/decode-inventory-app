<?php
    function alert($message, $location){
        echo "<script>
            alert('$message');
            location.href = '$location';
        </script>";
    }
?>