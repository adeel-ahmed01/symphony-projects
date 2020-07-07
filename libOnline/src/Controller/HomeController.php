<?php
namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(LivreRepository $livreRepository): Response
    {

        $livres = $livreRepository->findAll();
        
        return $this->render('home/home.html.twig', [
            'livres' => $livres,
        ] );
    }
}
