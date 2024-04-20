<?php
declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\Model\Post;
use App\View;

class Home
{
    public function index():View
    {
        $db = App::getDbInstace();
        // Begin transaction
        $db->getDb()->beginTransaction();

        $postModel = new Post();

        try {
            if (isset($_GET['search'])) {
             $searchTerm = $_GET['search'];
            $posts = $postModel->searchPost($searchTerm);
            } else {
            $posts = $postModel->getPosts();
            }
            // Perform database operations
            
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