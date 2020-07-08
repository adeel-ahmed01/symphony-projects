<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;

class DashboardController extends AbstractDashboardController
{
 
    /**
    * @Route("/admin")
    */
    public function index(): Response
    {

        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        // return $this->redirect($routeBuilder->setController(LivreCrudController::class)->generateUrl());
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration')
        ;
    }


    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa-home'),

            MenuItem::section('Entités'),
            MenuItem::linkToCrud('Livres', 'fa fa-tags', Livre::class),

        ];
    }
}
