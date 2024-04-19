<?php
declare(strict_types=1);

namespace App;

use App\Exception\ViewNotFoundException;

class View
{
    protected string $viewRelativePath;
    protected array $viewParams;

    public function __construct(string $viewPath, array $viewParams=[])
    {
        $this->viewRelativePath = $viewPath;
        $this->viewParams = $viewParams;
    }

    public static function make(string $view, array $params=[])
    {
        return new static($view, $params);
    }

    public function render(bool $withTemplate=true)
    {
        $viewPath = VIEWS_PATH . $this->viewRelativePath . '.php';

        if (!is_file($viewPath)) {
            throw new ViewNotFoundException();
        }

        foreach ($this->viewParams as $key => $value) {
            $$key = $value;
        }
        
        ob_start();
        if ($withTemplate) {
            include VIEWS_PATH . 'partials/head.php';
            include VIEWS_PATH . 'partials/nav.php';
        }
        include $viewPath;

        if ($withTemplate) {
            include VIEWS_PATH . 'partials/footer.php';
        }

        return (string)ob_get_clean();      
    }

    public function __toString(){
        return $this->render();
    }

        public function __get(string $key)
    {
        return $this->params[$key] ?? null;   
    }
}