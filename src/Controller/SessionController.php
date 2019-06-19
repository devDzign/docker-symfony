<?php

namespace App\Controller;

use App\Entity\Session;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    /**
     * @Route("/session", name="session")
     */
    public function index(SessionRepository $session)
    {
        return $this->render(
            'session/index.html.twig',
            [
                'sessions' => $session->findBy([], ['datetime' => 'ASC']),
            ]
        );
    }

    /**
     * @Route("/session/{id}", name="session_detail")
     */
    public function detail(Session $session)
    {
        return $this->render(
            'session/show.html.twig',
            [
                'session' => $session,
            ]
        );
    }
}
