<?php

namespace App\Controller\Main;

use App\Entity\Tags;
use App\Form\TagsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagsController extends AbstractController
{
    #[Route('/tags', name: 'tags')]
    public function index(): Response
    {
        $tags = $this->getDoctrine()->getRepository(Tags::class)->findAll();

        return $this->render('main/tags/index.html.twig', array(
            'tags' => $tags,
            'title' => 'Tags',
        ));
    }

    #[Route('/tags/add', name: 'add_tags')]
    public function addTag(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tag = new Tags();
        $form = $this->createForm(TagsType::class, $tag);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($tag);
            $entityManager->flush();

            return $this->redirectToRoute('main_tags');
        }
        $forRender['title'] = 'tag creation';
        $forRender['addtagForm'] = $form->createView();
        return $this->render('main/tags/form.html.twig', $forRender);
    }


}
