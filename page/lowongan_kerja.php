<?php 
if ($_SESSION['user']['id_role'] == 2) {
    require_once 'content/loker/hrd_page.php';
}else{
    require_once 'content/loker/pelamar_page.php';
}
?>