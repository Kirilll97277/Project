<?php

namespace App\Controller\Main;

use App\Entity\Collection;
use App\Entity\CollectionAttribute;
use App\Entity\Comment;
use App\Entity\Item;
use App\Entity\ItemAttribute;
use App\Form\CollectionsType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserCollectionsController extends AbstractController
{
    #[Route('/user/collections', name: 'main_user_collections')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $collection = $entityManager->getRepository(Collection::class)->findAll();

        return $this->render('main/user_collections/index.html.twig', array(
            'collections' => $collection,
            'title' => 'Collections',
            ));
    }

    #[Route('/my/collections', name: 'my_collections')]
    public function showMyCollections(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $collection = $entityManager->getRepository(Collection::class)->findBy(['user' => $user]);

        return $this->render('main/my_collections/index.html.twig', array(
            'collections' => $collection,
            'title' => 'My Collections',
        ));
    }

    #[Route('/user/collections/create', name: 'main_user_collections_create')]
    public function addCollection(Request $request,
                                  EntityManagerInterface $entityManager,
                                  FileUploader $fileUploader
    ): Response
    {
        $collection = new Collection();
        $form = $this->createForm(CollectionsType::class, $collection);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            if($file){
                $collection->getUploadAd(new \DateTime());
                $upload =  $fileUploader->uploadOnDropbox($file);
                $collection->setImage($upload['link']);
                $collection->setImageId($upload['id']);
            }
            $collection->setUser($this->getUser());
            $entityManager->persist($collection);
            $entityManager->flush();

            return $this->redirectToRoute('main_user_collections');
        }
        $forRender['title'] = 'Collections creation';
        $forRender['collectionForm'] = $form->createView();

        return $this->render('main/my_collections/form.html.twig', $forRender);
    }

    #[Route('/collection/{id}/edit', name: 'collection_edit', requirements: ['id' => '\d+'])]
    public function editCollection(Request $request,
                                   EntityManagerInterface $entityManager,
                                   FileUploader $fileUploader,
                                   int $id
    ): Response
    {
        $collection = $entityManager->getRepository(Collection::class)->findOneBy(['id' => $id]);
        $form =  $this->createForm(CollectionsType::class, $collection);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            if($file) {
                $collection->setUploadAd(new \DateTime());
                $upload = $fileUploader->uploadOnDropbox($file);
                $collection->setImage($upload['link']);
                $collection->setImageId($upload['id']);
            }

            $entityManager->flush();

            return $this->redirectToRoute('main_items_collection', array('id' => $id));
        }
        $forRender['title'] = 'Collection edit';
        $forRender['collectionForm'] = $form->createView();

        return $this->render('main/my_collections/form.html.twig', $forRender);
    }

    #[Route('/collection/{id}/delete', name: 'collection_delete', requirements: ['id' => '\d+'])]
    public function deleteCollection(Request $request,
                                     EntityManagerInterface $entityManager,
                                     int $id
    ): Response
    {
        $collection = $entityManager->getRepository(Collection::class)->findOneBy(['id' => $id]);
        $items = $entityManager->getRepository(Item::class)->findBy(['collection' => $id]);

        foreach ($items as $item){
            $comments = $entityManager->getRepository(Comment::class)->findBy(['item' => $item->getId()]);

            foreach ($comments as $comment){
                $entityManager->remove($comment);
            }
            $entityManager->remove($item);
        }
        $colAttributes = $entityManager->getRepository(CollectionAttribute::class)->findBy(['collection'=>$id]);

        foreach ($colAttributes as $colAttribute){
            $attributes = $entityManager->getRepository(ItemAttribute::class)->findBy(['collectionAttribute'=>$colAttribute]);

            foreach ($attributes as $attribute){
                $entityManager->remove($attribute);
                $entityManager->flush();
            }
            $entityManager->remove($colAttribute);
            $entityManager->flush();
        }
        $entityManager->remove($collection);
        $entityManager->flush();

        return $this->redirectToRoute('main_user_collections');
    }
}
