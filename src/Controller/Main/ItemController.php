<?php

namespace App\Controller\Main;

use App\Entity\Comment;
use App\Entity\Item;
use App\Entity\Like;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ItemController extends AbstractController
{
    #[Route('/item/{id}', name: 'item', requirements: ['id' => '\d+'])]
    public function index(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $comment = new Comment();
        $item = $entityManager->getRepository(Item::class)->findOneBy(['id'=>$id]);
        $comments = $entityManager->getRepository(Comment::class)->findBy(['item'=>$id]);
        $user = $this->getUser();
        $like = $entityManager->getRepository(Like::class)->findOneBy(['user' => $user,'item' => $item]);
        $form = $this->createForm(CommentType::class,$comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $comment->setItem($item);
            $comment->setCreateAt(new \DateTime());
            $comment->setUser($user);
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('item', array('id' => $id));
        }

        $forRender['itemForm'] = $form->createView();
        $forRender['like'] = $like;
        $forRender['item'] = $item;
        $forRender['comments'] = $comments;
        $forRender['id'] = $id;

        return $this->render('main/item/index.html.twig', $forRender);
    }
}
