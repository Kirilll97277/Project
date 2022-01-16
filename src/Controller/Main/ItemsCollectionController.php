<?php

namespace App\Controller\Main;

use App\Entity\Collection;
use App\Entity\Item;
//use phpDocumentor\Reflection\DocBlock\Tags\Method;
use App\Form\ItemType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemsCollectionController extends AbstractController
{
    #[Route('/main/collection/{id}', name: 'main_items_collection', requirements: ['id' => '\d+'])]
    public function index(int $id): Response
    {
        $item = $this->getDoctrine()->getRepository(Item::class)->findBy(['Collection' => $id]);

        return $this->render('main/items_collection/index.html.twig',  array(
            'items' => $item,
            'title' => 'Items',
        ));
    }

    #[Route('/main/user/collection/item/create/', name: 'main_user_item_create')]
    public function addCollection(Request $request, EntityManagerInterface $entityManager): Response
    {
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $item->setCreateDate(date());
            $item->setCollection();
            $entityManager->persist($item);
            $entityManager->flush();

            return $this->redirectToRoute('main_items_collection', array('id' => $item->getCollection()));
        }
        $forRender['title'] = 'Item creation';
        $forRender['itemForm'] = $form->createView();

        return $this->render('main/items_collection/form.html.twig', $forRender);
    }

}