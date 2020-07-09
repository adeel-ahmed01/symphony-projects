<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserInfoType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController {

    /**
     * @param UsersRepository $repository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(UsersRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    public function index()
    {
        $users = $this->repository->findAll();
        return $this->render('home', compact('users'));
    }

    /**
     * @Route("/profile/{id}", name="profile.edit", methods="GET|POST")
     * @param Users $user
     * @param Request $request
     * @return Response
     */
    public function edit(Users $user, Request $request)
    {
        $form = $this->createForm(UserInfoType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Informations sauvegardées!');
            return $this->redirectToRoute('home');
        }

        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'form'     => $form->createView()
        ]);
    }

}

