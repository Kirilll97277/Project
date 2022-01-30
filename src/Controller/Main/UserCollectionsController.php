<?php

namespace App\Controller\Main;

use App\Entity\Collection;
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
    public function index(): Response
    {
        $collection = $this->getDoctrine()->getRepository(Collection::class)->findAll();

        return $this->render('main/user_collections/index.html.twig', array(
            'collections' => $collection,
            'title' => 'Collections',
            ));
    }

    #[Route('/user/my/collections', name: 'main_my_collections')]
    public function showMyCollections(): Response
    {
        $user = $this->getUser();
        $collection = $this->getDoctrine()->getRepository(Collection::class)->findBy(['user' => $user]);

        return $this->render('main/my_collections/index.html.twig', array(
            'collections' => $collection,
            'title' => 'Collections',
        ));
    }

    #[Route('/user/collections/create', name: 'main_user_collections_create')]
    public function addCollection(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
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


}
