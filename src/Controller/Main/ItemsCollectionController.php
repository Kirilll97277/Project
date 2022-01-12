<?php

namespace App\Controller\Main;

use App\Entity\Item;
//use phpDocumentor\Reflection\DocBlock\Tags\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemsCollectionController extends AbstractController
{
    #[Route('/main/collection/{id}', name: 'main_items_collection', requirements: ['id' => '\d+'])]
    public function index(int $id): Response
    {
        $item = $this->getDoctrine()->getRepository(Item::class)->findBy(['Collection' => $id]);

        return $this->render('main/items_collection/index.html.twig',  array(
            'Items' => $item,
            'title' => 'Items',
        ));
    }
}
