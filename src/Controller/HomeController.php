<?php

namespace App\Controller;

use App\Form\SearchBarType;
use App\Repository\EquipementInterieurRepository;
use App\Repository\GiteRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, GiteRepository $giteRepository): Response
    {
        $gites = $giteRepository->findAll();

        $searchForm = $this->createForm(SearchBarType::class);
        $searchForm->handleRequest($request);

        return $this->render('home/index.html.twig', ["gites" => $gites, 'form' => $searchForm->createView()]);
    }

    #[Route('/gite/{id}', name: "show_gite")]
    public function showGite(int $id, GiteRepository $giteRepository): Response
    {
        $gite = $giteRepository->findGiteById($id);

        $equipementsInt = $giteRepository->findAllInsideEquipmentsForAGiteByGiteId($id);
        if (!empty($equipementsInt)) {
            $equipementsInterieurs = $equipementsInt[0]->getEquipementInterieur()->toArray();
        } else {
            $equipementsInterieurs = ["0" => ['nom' => "Pas d'équipements interieur", 'description' => ""]];
        }

        $equipementsExt = $giteRepository->findAllOutsideEquipmentsForAGiteByGiteId($id);
        if (!empty($equipementsExt)) {
            $equipementsExterieurs = $equipementsExt[0]->getEquipementExterieur()->toArray();
        } else {
            $equipementsExterieurs = ["0" => ['nom' => "Pas d'équipements exterieur", 'description' => ""]];
        }

        $services = $giteRepository->findAllServicesForAGiteByGiteId($id);
        if (!empty($services)) {
            $servicesGite = $services[0]->getService()->toArray();
        } else {
            $servicesGite = ["0" => ['nom' => "Pas de services proposés"]];
        }


        return $this->render('home/show_gite.html.twig', ["gite" => $gite, "equipementsInt" => $equipementsInterieurs, "equipementsExt" => $equipementsExterieurs, "services" => $servicesGite]);
    }
}
