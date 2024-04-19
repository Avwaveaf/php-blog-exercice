<?php
declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\View;

class Home
{
    public function index():View
    {
        $db = App::getDbInstace();

      
        // Begin transaction
        $db->getDb()->beginTransaction();

        try {
            // Perform database operations
            $posts = $db->query("SELECT p.title, p.slug, p.content, p.created_at, u.username 
                FROM posts p 
                JOIN users u ON p.author_id = u.id",[],
                \PDO::FETCH_ASSOC);

            // Commit transaction if all operations succeed
            $db->getDb()->commit();
        } catch (\Exception $e) {
            // Rollback transaction if any operation fails
            $db->getDb()->rollBack();
            throw $e;
        }

        return View::make('home',
         ["header"=>"Welcome", "posts"=>$posts]);
    }
}