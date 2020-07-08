<?php
namespace App\Controller;

use App\Entity\Livre;
use App\Repository\LivreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;



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
            'se' => ''
        ] );
    }

    /**
     * @Route("/filter", name="home_filter")
     * @return Response
     */
    public function filter(LivreRepository $livreRepository, Request $request): Response
    {

        if ( $searchString = $request->get('search') ) {
            
            $searchString = strtolower($searchString);
            $oldLivres = $livreRepository->findAll();
            $newLivres = [];
            foreach($oldLivres as $livre) {
                $title = strtolower($livre->getTitre());
                if (strpos($title, $searchString) !== false ) {
                    $newLivres[] = $livre;
                }
            }
        
            return $this->render('home/home.html.twig', [
                'livres' => $newLivres,
            ] );
        }
       
    }
}
