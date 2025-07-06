<?php

if (!$_SESSION['user']) {
        header('location: ../../includes/logout.php');
}

?>