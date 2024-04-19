<?php
declare(strict_types=1);

namespace App\Controllers;

use App\App;

class Posts
{

  public function post(string $slug): string
    {
        $db = App::getDbInstace();

        $post = $db->queryOne("SELECT * FROM posts WHERE slug = ?",  [$slug], \PDO::FETCH_ASSOC);

        dumpnkill($post);
        return "Showing post with slug: $slug";
    }
}