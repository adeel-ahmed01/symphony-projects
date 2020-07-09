<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CheckoutController
 * @package App\Controller
 */
class CheckoutController extends AbstractController
{
    /**
     * Webservice permettant pour la gestion des commandes.
     *
     * @Route("checkout", name="chekout")
     * @param SessionInterface $session
     * @return Response
     */
    public function index(SessionInterface $session): Response
    {
        $cartOfBooks = $session->get('cartItems', []);
        $cartTotal = $session->get('totalPanier', []);

        return $this->render('commandes/checkout.html.twig', [
            'cartItems' => $cartOfBooks,
            'totalPanier' => $cartTotal
        ]);
    }
}