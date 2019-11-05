<?php

namespace App\Controller;

use App\Service\Waki;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;

/**
 * Class WakiController
 * @package App\Controller
 * @Route("/waki")
 */
class WakiController extends AbstractController
{

    /**
     * @Route("/pollution/index", name="Waki_pollution_index")
     * @param Request $request
     * @param Waki $waki
     * @return JsonResponse
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function pollutionIndex(Request $request, Waki $waki)
    {
        return $this->json($waki->getIndexPollutionByCountry($request->query->get('country')));
    }

}