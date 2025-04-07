<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AboutController extends AbstractController
{

    // #[Route('/about', name: 'app_about')]
    public function index(string $bodyId, Request $request): Response
    {
        // dd($request);
        return $this->render('about/index.html.twig', [
            'controller_name' => 'AboutController',
            'bodyId' => $bodyId
        ]);
    }
    public function parametres(string $paramUrl, int $numero, string $bodyId, Request $request): Response
    {
        // dd($request);
        
        return $this->render('about/parametres.html.twig', [
            'paramUrl' => $paramUrl,
            'controller_name' => 'AboutController',
            'methode' => 'GET',
            'numero' => $numero,
            'bodyId' => $bodyId,
            'routeName' => $request->attributes->get('_route'),
            'routeParams' => $request->attributes->get('_route_params'),
            'allAttributes' => $request->attributes->all()
        ]);
    }
}
