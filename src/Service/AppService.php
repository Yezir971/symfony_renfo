<?php

namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AppService
{
    private UrlGeneratorInterface $urlGenerator;
    public function __construct(UrlGeneratorInterface $urlGenerator){
        $this->urlGenerator = $urlGenerator;
    }
    public function getRelativeUrl()
    {
        return $this->urlGenerator->generate('app_parametre', ['paramUrl' => 'test', 'numero' => null]);
    }
    public function getAbsoluteUrl(){
        return $this->urlGenerator->generate('app_parametre', ['paramUrl' => 'test', 'numero' => 10], UrlGeneratorInterface::ABSOLUTE_URL);
    }
}