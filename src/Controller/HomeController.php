<?php

namespace App\Controller;

use App\Entity\Collection;
use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $collection = $entityManager->getRepository(Collection::class)->findByNumberItems();
        $items = $entityManager->getRepository(Item::class)->findByLastAdd();

        return $this->render('home/index.html.twig', [
            'title' => 'ItrCurs',
            'collections' => $collection,
            'items' => $items,
        ]);
    }
}
