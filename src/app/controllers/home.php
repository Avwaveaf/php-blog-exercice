<?php

$header = "Home page";

$sort = 'asc';

// defining the query parameters
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    dumpnkill($sort);
}

$posts = $db->query("select p.title, p.slug,p.content,  p.created_at,u.username from posts p join users u on p.author_id = u.id", PDO::FETCH_ASSOC);







require VIEWS_PATH . 'home.php';