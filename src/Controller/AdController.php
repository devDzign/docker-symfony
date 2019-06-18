<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     * @param AdRepository $repository
     *
     * @return Response
     */
    public function index(AdRepository $repository): Response
    {

        return $this->render(
            'ad/index.html.twig',
            [
                'ads' => $repository->findAll(),
            ]
        );
    }

    /**
     * @Route("/ads/{slug}", name="ads_show")
     * @param Ad $ad
     *
     * @return Response
     */
    public function show(Ad $ad): Response
    {
        return $this->render(
            'ad/show.html.twig',
            [
                'ad' => $ad,
            ]
        );
    }
}
