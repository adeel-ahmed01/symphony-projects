<?php


namespace App\Controller;


use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * RestController pour la gestion du panier.
 */
class CartController extends AbstractController
{

    /**
     * Webservice permettant d'obtenir les détails du panier.
     *
     * @Route("cart", name="cart")
     * @param SessionInterface $session
     * @param LivreRepository $livreRepository
     * @return Response
     */
    public function index(SessionInterface $session, LivreRepository $livreRepository): Response
    {
        $cart = $session->get('cart', []);

        $cartOfBooks = $this->getCartWithDetails($cart, $livreRepository);

        $cartTotal = $this->computeCartTotal($cartOfBooks);

        $session->set('cartItems', $cartOfBooks);
        $session->set('totalPanier', $cartTotal);

        return $this->render('panier/cart.html.twig', [
            'cartItems' => $cartOfBooks,
            'totalPanier' => $cartTotal
        ]);
    }

    /**
     * Webservice permettant d'ajouter un livre dans le panier.
     *
     * @Route("/cart/add/{livreId}", name="cart_add")
     * @param $livreId
     * @param SessionInterface $session
     * @return Response
     */
    public function add($livreId, SessionInterface $session): Response
    {
        // On récupère le panier s'il en existe un, sinon on en crée un vide
        $cart = $session->get('cart', []);

        if (!empty($cart[$livreId])) {
            // Si le livre est déjà dans le panier, on augmente sa quantité
            $cart[$livreId]++;
        } else {
            // Sinon on l'ajoute en initialisant sa quantité à 1
            $cart[$livreId] = 1;
        }
        // On remplace le panier de la session par le nouveau panier mis à jour
        $session->set('cart', $cart);

        return $this->redirectToRoute('home');
    }

    /**
     * Webservice permettant de retirer un livre du panier.
     *
     * @Route("/cart/remove/{livreId}", name="cart_remove")
     * @param $livreId
     * @param SessionInterface $session
     * @param Request $request
     * @param LivreRepository $livreRepository
     * @return Response
     */
    public function remove($livreId, SessionInterface $session, Request $request, LivreRepository $livreRepository): Response
    {
        // On récupère le panier s'il en existe un, sinon on en crée un vide
        $cart = $session->get('cart', []);

        if (!empty($cart[$livreId])) {
            // Si le livre est dans le panier, on le retire
            unset($cart[$livreId]);

        }
        // On remplace le panier de la session par le nouveau panier mis à jour
        $session->set('cart', $cart);

        $cartOfBooks = $this->getCartWithDetails($cart, $livreRepository);

        $cartTotal = $this->computeCartTotal($cartOfBooks);

        $session->set('cartItems', $cartOfBooks);
        $session->set('totalPanier', $cartTotal);

        if (sizeof($cart) <= 0) {
            return $this->redirectToRoute('cart');
        }

        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }

    /**
     * Méthode permettant de calculer le montant total du panier.
     *
     * @param $cartOfBooks
     */
    public function computeCartTotal($cartOfBooks)
    {
        $total = 0;

        foreach ($cartOfBooks as $bookInCart) {
            $totalPerBook = $bookInCart['livre']->getPrix() * $bookInCart['quantity'];
            $total += $totalPerBook;
        }

        return $total;
    }

    /**
     * Méthode permettant d'obtenir le panier avec le détail des livres.
     *
     * @param $cartOfBooks
     */
    public function getCartWithDetails($cart, $livreRepository)
    {
        $cartWithDetails = [];

        foreach ($cart as $idLivre => $quantity) {
            $cartWithDetails[] = [
                'livre' => $livreRepository->find($idLivre),
                'quantity' => $quantity
            ];
        }

        return $cartWithDetails;
    }
}