<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('Home page!');
    }

    /**
     * @Route("/questions/{slug}")
     */
    public function show()
    {
        return new Response('Show question!');
    }
}
