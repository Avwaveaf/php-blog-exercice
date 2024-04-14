<?php

$header = "Home page";

$sort = 'asc';

// defining the query parameters
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    dumpnkill($sort);
}





require VIEWS_PATH . 'home.php';