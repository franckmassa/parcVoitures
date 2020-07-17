<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    /**
     * @Route("/client/voitures", name="voitures")
     */
    public function index(VoitureRepository $repo)
    {
        $voitures = $repo->findAll();
        return $this->render('voiture/voitures.html.twig', [
            "voitures" => $voitures
        ]);
    }
}
