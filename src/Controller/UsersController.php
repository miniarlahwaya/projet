<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
//use Doctrine\Persistence\ManagerRegistry;//

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UsersController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

  /*  #[Route('/new', name: 'app_users_new')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {
        $user= new Users();
        $form = $this->createForm(UsersType::class, $user);
        

        
        return $this->renderForm('home/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

*/


 #[Route('/add', name: 'app_users_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UsersRepository $UsersRepository): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $UsersRepository>save($user, true);

            return $this->redirectToRoute('app_users_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('home/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }










}
