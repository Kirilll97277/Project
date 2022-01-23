<?php

namespace App\Controller;

use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        //$item = $this->getDoctrine()->getRepository(Item::class)->findBy(['create_date']);

        return $this->render('home/index.html.twig', [

        ]);
    }
}
