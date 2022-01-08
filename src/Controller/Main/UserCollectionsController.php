<?php

namespace App\Controller\Main;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCollectionsController extends AbstractController
{
    #[Route('/main/user/collections', name: 'main_user_collections')]
    public function index(): Response
    {

        return $this->render('main/user_collections/index.html.twig', [
            'controller_name' => 'UserCollectionsController',
        ]);
    }
}
