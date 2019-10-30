<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ASQICNController extends AbstractController
    {
    /**
    * @Route("/test", name="ASQICN_test")
    */
    public function test()
    {
        return $this->json(['test' => 'test']);
    }
}