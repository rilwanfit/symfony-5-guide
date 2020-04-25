<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comments/{id}/vote/{direction<up|down>}" methods="POST")
     */
    public function commentVote($id, $direction)
    {
        $currentVoteCount = rand(0, 5);

        if ($direction === 'up') {
            $currentVoteCount = rand(6, 10);
        }

        return $this->json(['votes' => $currentVoteCount]);
    }
}
