<?php

namespace App\Controller;

use App\Service\ASQICNAPI;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ASQICNController
 * @package App\Controller
 * @Route("/ASQICN")
 */
class ASQICNController extends AbstractController
    {
    /**
    * @Route("/map/bound", name="ASQICN_map_bound")
    */
    public function mapBound()
    {
        $ASQICNAPI = new ASQICNAPI();
        $result = $ASQICNAPI->mapBound(39.379436,116.091230,40.235643,116.784382);
        return $this->json($result);
    }
}