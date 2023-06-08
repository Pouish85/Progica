<?php

namespace App\Controller;

use App\Form\BookingType;
use App\Form\SearchBarType;
use App\Form\SearchData;
use App\Repository\GiteRepository;
use App\Repository\PrixRepository;
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
        $searchForm = $this->createForm(SearchBarType::class, null, [
            'data_class' => SearchData::class,
        ]);
        // $searchForm->remove('extendToDepartement');
        // $searchForm->remove('extendToRegion');
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $searchFormData = $searchForm->getData();
            $nbChambres = $searchFormData->getNbChambres();
            $acceptAnimaux = $searchFormData->isAcceptAnimaux();
            $ville = $searchFormData->getVille();
            $extendToDepartement = $searchFormData->isExtendToDepartement();
            $extendToRegion = $searchFormData->isExtendToRegion();
            $equipementInterieur = $searchFormData->getEquipementInterieur();
            $equipementExterieur = $searchFormData->getEquipementExterieur();
            $service = $searchFormData->getService();

            // dd($nbChambres);
            if ($nbChambres !== null) {
                $options['nbChambres'] = $nbChambres;
            }
            if ($acceptAnimaux === true) {
                $options['acceptAnimaux'] = $acceptAnimaux;
            }
            if ($ville !== null) {
                $options['ville'] = $ville;
            }
            if ($extendToDepartement === true) {
                $options['extendToDepartement'] = $extendToDepartement;
            }
            if ($extendToRegion === true) {
                $options['extendToRegion'] = $extendToRegion;
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

            $gites = $giteRepository->findGiteByOptions($options);
        }
        // dd($options);

        return $this->render('home/index.html.twig', ["gites" => $gites, 'form' => $searchForm->createView()]);
    }

    #[Route('/gite/{id}', name: "show_gite")]
    public function showGite(int $id, Request $request, GiteRepository $giteRepository, PrixRepository $prixRepository): Response
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

        $bookingForm = $this->createForm(BookingType::class);
        $bookingForm->handleRequest($request);
        // dd($gite->getId());

        //Tarif a vérifier
        // $tarif = "{$prixRepository->findPriceForAGiteId($gite->getId())->getTarif()} € /nuit";


        $style = "";
        // dd($tarif->getTarif());
        if ($bookingForm->isSubmitted() && $bookingForm->isValid()) {
            $bookingFormData = $bookingForm->getData();
            $dateDebut = $bookingFormData->getDebut();

            $tarif = $prixRepository->findPriceByDate($dateDebut);
            if ($tarif === null) {
                $tarif = "Pas de tarif enregistré pour cette date";
                $style = "text-danger-color font-bold text-center";
            } else {
                $tarif = "{$tarif->getTarif()} € /nuit";
            }
        }
        // dd($tarif);


        //Tarif a vérifier
        // return $this->render('home/show_gite.html.twig', ["gite" => $gite, "equipementsInt" => $equipementsInterieurs, "equipementsExt" => $equipementsExterieurs, "services" => $servicesGite, 'form' => $bookingForm->createView(), 'tarif' => $tarif, 'style' => $style]);
        return $this->render('home/show_gite.html.twig', ["gite" => $gite, "equipementsInt" => $equipementsInterieurs, "equipementsExt" => $equipementsExterieurs, "services" => $servicesGite, 'form' => $bookingForm->createView(), 'style' => $style]);
    }
}
