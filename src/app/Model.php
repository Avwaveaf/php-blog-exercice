<?php

declare(strict_types=1);

namespace App;

abstract class Model{
    protected Database $db;
    
    public function __construct()
    {
        $this->db = App::getDbInstace();
    }
}
