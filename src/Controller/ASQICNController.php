<?php

namespace App\Controller;

use App\Service\ASQICNAPI;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;

/**
 * Class ASQICNController
 * @package App\Controller
 * @Route("/ASQICN")
 */
class ASQICNController extends AbstractController
    {
    /**
     * @Route("/map/bound", name="ASQICN_map_bound")
     * @param Request $request
     * @param ASQICNAPI $ASQICNAPI
     * @return JsonResponse
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function mapBound(Request $request, ASQICNAPI $ASQICNAPI)
    {
        $lat1 = floatval($request->query->get('lat1'));
        $lng1 = floatval($request->query->get('lng1'));
        $lat2 = floatval($request->query->get('lat2'));
        $lng2 = floatval($request->query->get('lnt2'));
        $result = $ASQICNAPI->mapBound($lat1, $lng1, $lat2, $lng2);
        return $this->json($result);
    }

    /**
     * @Route("/search", name="ASQICN_search")
     * @param Request $request
     * @param ASQICNAPI $ASQICNAPI
     * @return JsonResponse
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function search(Request $request, ASQICNAPI $ASQICNAPI)
    {
        $result = $ASQICNAPI->search($request->query->get('keyword'));
        return $this->json($result);
    }
}