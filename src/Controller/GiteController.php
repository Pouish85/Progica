<?php

namespace App\Controller;

use App\Entity\Gite;
use App\Form\NewGiteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GiteController extends AbstractController
{
    #[Route('/newGite', name: 'new_gite')]
    public function index(Request $request): Response
    {
        $newGite = new Gite;

        $newGiteForm = $this->createForm(NewGiteType::class);
        $newGiteForm->handleRequest($request);





        return $this->render('gite/index.html.twig', [
            'form' => $newGiteForm->createView(),
        ]);
    }
}
