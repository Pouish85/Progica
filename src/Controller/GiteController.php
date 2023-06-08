<?php

namespace App\Controller;

use App\Entity\Gite;
use App\Entity\Prix;
use App\Form\NewGite;
use App\Form\NewGiteType;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GiteController extends AbstractController
{
    #[Route('/newGite', name: 'new_gite')]
    public function index(Request $request, EntityManagerInterface $em, VilleRepository $villeRepository): Response
    {
        $newGite = new Gite;

        $newGiteForm = $this->createForm(NewGiteType::class);
        $newGiteForm->handleRequest($request);

        // dd($newGiteForm);
        if ($newGiteForm->isSubmitted() && $newGiteForm->isValid()) {
            $newGiteFormData = $newGiteForm->getData();
            // $prixValue = $newGiteFormData->prix;
            // $prixValue = 450;
            // Rechercher l'objet Prix correspondant en utilisant la valeur récupérée
            // $prixObject = $em->getRepository(Prix::class)->findOneBy(['valeur' => $prixValue]);
            // Définir la propriété $prix avec l'objet Prix récupéré

            // dd($newGiteFormData);
            $giteWithIdOne = $em->getRepository(Gite::class)->find(1);
            $prixObject = $giteWithIdOne->getPrix();



            // dd($newGiteFormData);
            $newGite->setNomGite($newGiteFormData->nomGite);
            $newGite->setTarifLocation($newGiteFormData->tarifLocation);
            $newGite->setSurface($newGiteFormData->surface);
            $newGite->setNbChambres($newGiteFormData->nbChambres);
            $newGite->setNbLits($newGiteFormData->nbLits);
            $newGite->setAcceptAnimaux($newGiteFormData->acceptAnimaux);
            if ($newGiteFormData->acceptAnimaux === true) {
                $newGite->setTarifAnimaux($newGiteFormData->tarifAnimaux);
            }
            if ($newGiteFormData->nouvelleVilleNom !== null) {
                //Si nouvelle ville entrée, ajout de cette ville a la bdd
                $nouvelleVilleNom = $newGiteFormData->nouvelleVilleNom;
                $nouvelleVilleDepartementId = $newGiteFormData->departement->getId();

                $nouvelleVille = $villeRepository->createNouvelleVille($nouvelleVilleNom, $nouvelleVilleDepartementId);

                $newGite->setVille($nouvelleVille);
            } else {
                $newGite->setVille($newGiteFormData->ville);
            }
            $newGite->setImage($newGiteFormData->image);
            $newGite->setproprietaire($newGiteFormData->proprietaire);
            $newGite->setContact($newGiteFormData->contact);
            $newGite->setPrix($prixObject);
            $newGite->setEquipementExterieur($newGiteFormData->equipementExterieur);
            $newGite->setEquipementInterieur($newGiteFormData->equipementInterieur);
            // $newGite->setService($newGiteFormData->service);

            // dd($newGite);

            $em->persist($newGite);
            $em->flush();


            return $this->redirectToRoute('show_gite', ['id' => $newGite->getId()]);
        }



        return $this->render('gite/index.html.twig', [
            'form' => $newGiteForm->createView(),
        ]);
    }
}
