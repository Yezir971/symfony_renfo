<?php

namespace App\Controller;

use App\Service\AppService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class HomeController extends AbstractController
{
    private UrlGeneratorInterface $urlGenerator; 
    public function __construct(UrlGeneratorInterface $urlGenerator){
        $this->urlGenerator = $urlGenerator;
    }
    // #[Route('/home', name: 'app_home')]
    public function index(string $bodyId, AppService $appService): Response
    {
        $relUrl = $appService->getRelativeUrl();
        $absUrl = $appService->getAbsoluteUrl();
        // $relUrl = $this->generateUrl('app_parametre', ['paramUrl' => 'test', 'numero' => 10]);
        // $absUrl = $this->generateUrl('app_parametre', ['paramUrl' => 'test', 'numero' => 10], UrlGeneratorInterface::ABSOLUTE_URL);
        // dd($relUrl, $absUrl);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'toto',
            'url' => $this->generateUrl('app_about'),
            'bodyId' => $bodyId,
            'link' => $absUrl
        ]);
    }
}
