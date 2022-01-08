<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCollectionsController extends AbstractController
{
    #[Route('/admin/admin/collections', name: 'admin_collections')]
    public function index(): Response
    {
        return $this->render('admin/admin_collections/index.html.twig', [
            'controller_name' => 'AdminCollectionsController',
        ]);
    }
}
