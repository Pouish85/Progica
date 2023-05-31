<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchBarType;
use App\Repository\GiteRepository;
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
        $options = [];
        $searchData = new SearchData();
        $searchForm = $this->createForm(SearchBarType::class, $searchData);
        // $searchForm = $this->createForm(SearchBarType::class);
        $searchForm->handleRequest($request);
        // dd($searchForm);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            // dd($searchForm->getData());
            $searchFormData = $searchForm->getData();
            $nbChambres = $searchFormData->getNbChambres();
            $acceptAnimaux = $searchFormData->isAcceptAnimaux();
            $ville = $searchFormData->getVille();
            $equipementInterieur = $searchFormData->getEquipementInterieur();
            $equipementExterieur = $searchFormData->getEquipementExterieur();
            $service = $searchFormData->getService();
            // dd($service);
            // dump('EquipementInterieur:', $equipementInterieur, 'EquipementExterieur:', $equipementExterieur,);

            if ($nbChambres !== null) {
                $options['nbChambres'] = $nbChambres;
                // dd($options);
            }
            if ($acceptAnimaux === true) {
                $options['acceptAnimaux'] = $acceptAnimaux;
                // dd($options);
            }
            if ($ville !== null) {
                $options['ville'] = $ville;
            }
            if ($equipementInterieur !== null && !$equipementInterieur->isEmpty()) {
                $options['equipementInterieur'] = $equipementInterieur;
            }
            if ($equipementExterieur !== null && !$equipementExterieur->isEmpty()) {
                $options['equipementExterieur'] = $equipementExterieur;
            }
            if ($service !== null && !$service->isEmpty()) {
                $options['service'] = $service;
            }



            // dd($equipementExterieur);
            // dd($searchFormData, $options);
            $gites = $giteRepository->findGiteByOptions($options);
            // $gites = $giteRepository->testGite($options);
            // dump('Gites', $gites);
            // dd($gites);
        }

        // dd('fin de fonction');
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
