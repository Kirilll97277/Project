<?php

namespace App\Controller\Main;

use App\Entity\Collection;
use App\Entity\Comment;
use App\Entity\Item;
//use phpDocumentor\Reflection\DocBlock\Tags\Method;
use App\Entity\CollectionAttribute;
use App\Entity\ItemAttribute;
use App\Form\ItemType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemsCollectionController extends AbstractController
{
    #[Route('/collection/{id}', name: 'main_items_collection', requirements: ['id' => '\d+'])]
    public function index(int $id): Response
    {
        $item = $this->getDoctrine()->getRepository(Item::class)->findBy(['collection' => $id]);
        $collection = $this->getDoctrine()->getRepository(Collection::class)->findOneBy(['id'=> $id]);

        return $this->render('main/items_collection/index.html.twig',  array(
            'collection' => $collection,
            'items' => $item,
            'title' => 'Items',
            'id' =>$id,
        ));
    }

    #[Route('collection/{id}/item/create', name: 'main_user_item_create', requirements: ['id' => '\d+'])]
    public function createItem(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $collection = $this->getDoctrine()->getRepository(Collection::class)->find(['id' => $id]);

        if (null === $collection) {
            return $this->redirectToRoute('home');
        }

        $item = new Item();
        $item->setCollection($collection);

        foreach ($collection->getAttributes() as $attribute) {
            $item->addItemAttribute((new ItemAttribute())->setItem($item)->setCollectionAttribute($attribute));
        }

        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item->setCreateDate(new \DateTime());
            $entityManager->persist($item);
            $entityManager->flush();

            return $this->redirectToRoute('main_items_collection', array('id' => $id));
        }

        $forRender['title'] = 'Item creation';
        $forRender['itemForm'] = $form->createView();

        return $this->render('main/items_collection/form.html.twig', $forRender);
    }

    #[Route('/item/{id}/edit/', name: 'item_edit', requirements: ['id' => '\d+'])]
    public function editItem(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $item = $this->getDoctrine()->getRepository(Item::class)->find(['id' => $id]);
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('main_items_collection', array('id' => $id));
        }

        $forRender['title'] = 'Item edit';
        $forRender['itemForm'] = $form->createView();

        return $this->render('main/items_collection/form.html.twig', $forRender);
    }

    #[Route('/item/{id}/delete/', name: 'item_delete', requirements: ['id' => '\d+'])]
    public function deleteItem(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $item = $entityManager->getRepository(Item::class)->findOneBy(['id' => $id]);
        $col_id = $item->getCollection()->getId();
        $comments = $entityManager->getRepository(Comment::class)->findBy(['item' => $id]);

        foreach ($comments as $comment) {
            $entityManager->remove($comment);
        }
        $entityManager->remove($item);
        $entityManager->flush();

        return $this->redirectToRoute('main_items_collection', array('id' => $col_id));
    }

}
