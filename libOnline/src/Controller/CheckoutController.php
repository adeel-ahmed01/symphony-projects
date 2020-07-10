<?php


namespace App\Controller;

use App\Entity\ArticleCommande;
use App\Entity\Commandes;
use App\Entity\Factures;
use App\Entity\Users;
use App\Form\UserInfoType;
use App\Repository\CommandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function index(Request $request, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        $cartOfBooks = $session->get('cartItems', []);
        $cartTotal = $session->get('totalPanier', []);

        if(sizeof($cart) <= 0) {
            return $this->render('panier/cart.html.twig');
        }

        $form = $this->createForm(UserInfoType::class, $this->getUser());
        $form->handleRequest($request);

        return $this->render('commandes/checkout.html.twig', [
            'cartItems' => $cartOfBooks,
            'totalPanier' => $cartTotal,
            'checkoutForm' => $form->createView()
        ]);
    }

    /**
     * Webservice permettant d'obtenir les commandes du User connecté.
     *
     * @Route("commandes_user/{user}", name="commandes_user")
     * @param Users $user
     * @param CommandesRepository $commandesRepository
     * @return Response
     */
    public function commandesUser(Users $user, CommandesRepository $commandesRepository): Response
    {

        $commandes = $commandesRepository->findByUserId($user->getId());

        return $this->render('commandes/commandes_user.html.twig', [
            'commandes' => $commandes
        ]);
    }

    /**
     * Webservice permettant de confirmer et d'enregistrer une commande.
     *
     * @Route("checkout_completed/{user}", name="chekout_completed", methods="GET|POST")
     * @param Users $user
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function checkoutCompleted(Users $user, Request $request, SessionInterface $session): Response
    {

        // Récupération des coordonnées du user

        $form = $this->createForm(UserInfoType::class, $user);

        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
        }

        // Récupération du panier

        $cartOfBooks = $session->get('cartItems', []);
        $cartTotal = $session->get('totalPanier', []);

        // Création de la commande

        $commande = new Commandes();
        $commande->setUserId($user->getId());

        $facture = new Factures();
        $facture->setPrixTotal($cartTotal);

        $commande->setFacture($facture);
        $commande->setPrixTTC($cartTotal + ($cartTotal * 0.20));

        $em->persist($commande);

        // Sauvegarde des articles achetés avec leur quantité

        foreach ($cartOfBooks as $bookInCart) {
            $articleCommande = new ArticleCommande();
            $articleCommande->setCommande($commande);
            $articleCommande->setLivreId($bookInCart['livre']->getId());
            $articleCommande->setQuantite($bookInCart['quantity']);
            $em->persist($articleCommande);
        }

        $em->flush();

        // On réinitialise le panier une fois la commande enregistrée

        $session->set('cart', []);
        $session->set('cartItems', []);
        $session->set('totalPanier', 0);

        return $this->render('commandes/checkout_completed.html.twig', []);
    }
}