<?php

declare(strict_types=1);

namespace App\Model;

use App\Model;

class Post extends Model
{
    public function getPosts(int $fetchMode = \PDO::FETCH_ASSOC): array
    {
        // perform qwuery to fetrch all available posts
        return $this->db->query("SELECT p.title, p.slug,p.created_at,p.content,  p.updated_at , u.username FROM posts p JOIN users u on p.author_id = u.id", [],$fetchMode);
    }

    public function searchPost(string $searchQuery): array
    {
        return $this->db->query(
            "SELECT p.title, p.slug,p.created_at,p.content,  p.updated_at , u.username 
            FROM posts p
             JOIN users u
              on p.author_id = u.id
               where p.title 
               like :searchQuery 
               or p.content 
            like :searchQuery", ['searchQuery'=> '%' . $searchQuery . '%'], \PDO::FETCH_ASSOC);
    }
}