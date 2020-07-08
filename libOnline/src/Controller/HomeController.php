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
        ] );
    }

    /**
     * @Route("/filter", name="home_filter")
     * @return Response
     */
    public function filter(LivreRepository $livreRepository, Request $request): Response
    {

        if ( $searchString = $request->get('search') ) {
            
            // Search string and categories
            $searchString = strtolower($searchString);
            $categorie = $request->get('categorie');

            // Filtered livres
            $oldLivres = $livreRepository->findAll();
            $newLivres = [];
            foreach($oldLivres as $livre) {
                // 
                if ( $categorie === 'titre') {
                    $title = strtolower($livre->getTitre());
                    if (strpos($title, $searchString) !== false ) {
                        $newLivres[] = $livre;
                    }
                } 

                if( $categorie === 'editeur') {
                    $editeur = strtolower($livre->getEditeur());
                    if (strpos($editeur, $searchString) !== false ) {
                        $newLivres[] = $livre;
                    }
                }
                
            }
        
            return $this->render('home/home.html.twig', [
                'livres' => $newLivres,
            ] );
        }


       
    }
}
