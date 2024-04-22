<?php
declare(strict_types=1);

namespace App\Services;

/**
 * This is just practicing dependency injection
 */
class PostService
{

    public function __construct(
        protected EmailService $emailService
    )
    {}

    public function process($user)
    {
        $this->emailService->send($user, 'Subscription Mail');
        echo "email has been sent </br>";
        return true;
    }
}