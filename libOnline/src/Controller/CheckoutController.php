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
     * Webservice permettant d'obtenir le formulaire de commande.
     *
     * @Route("checkout", name="chekout")
     * @param SessionInterface $session
     * @return Response
     */
    public function index(SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        $cartOfBooks = $session->get('cartItems', []);
        $cartTotal = $session->get('totalPanier', []);

        if(sizeof($cart) <= 0) {
            return $this->render('panier/cart.html.twig');
        }

        return $this->render('commandes/checkout.html.twig', [
            'cartItems' => $cartOfBooks,
            'totalPanier' => $cartTotal
        ]);
    }

    /**
     * Webservice permettant d'enregistrer et de confirmer une commande.
     *
     * @Route("checkout_completed", name="chekout_completed")
     * @param SessionInterface $session
     * @return Response
     */
    public function checkoutCompleted(SessionInterface $session): Response
    {
        $session->set('cart', []);
        $session->set('cartItems', []);
        $session->set('totalPanier', 0);
        return $this->render('commandes/checkout_completed.html.twig', []);
    }
}