<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{

    #[Route('/signup', name: 'signup')]
    public function signup(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface, EntityManagerInterface $em): Response
    {
        $newUser = new User;
        $newUserForm = $this->createForm(UserType::class);
        $newUserForm->handleRequest($request);

        if ($newUserForm->isSubmitted() && $newUserForm->isValid()) {
            $newUserFormData = $newUserForm->getData();
            // dd($newUserFormData);
            $hashedPassword = $userPasswordHasherInterface->hashPassword($newUser, $newUserFormData->getPassword());
            $nom = $newUserFormData->getNom();

            $newUser->setEmail($newUserFormData->getEmail());
            $newUser->setPassword($hashedPassword);
            $newUser->setNom($nom);
            $newUser->setPreNom($newUserFormData->getPrenom());
            $newUser->setRole($newUserFormData->getRole());

            // dd($newUserFormData, $newUser);
            $em->persist($newUser);
            $em->flush();

            flash()->addSuccess("Bienvenue sur Progica");
        }




        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController', 'form' => $newUserForm
        ]);
    }

    #[Route('/signin', name: 'signin')]
    public function signin(AuthenticationUtils $authenticationUtils): Response
    {

        if ($this->getUser()) {
            dd('dans le if getUser');
            return $this->redirectToRoute('home');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $username = $authenticationUtils->getLastUsername();




        return $this->render('security/signin.html.twig', [
            'error' => $error,
            'username' => $username

        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
    }
}
