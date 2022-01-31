<?php

namespace App\Controller\Main;

use App\Entity\Item;
use App\Entity\Like;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemLikeController extends AbstractController
{
    #[Route('/item/{id}/like', name: 'item_like', requirements: ['id' => '\d+'])]
    public function index(int $id, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $item = $entityManager->getRepository(Item::class)->findOneBy(['id'=>$id]);
        $like = $entityManager->getRepository(Like::class)->findOneBy(['user' => $user,'item' => $item]);

        if (!$like) {

            $like = new Like();
            $like->setUser($user);
            $like->setItem($item);
            $like->setIsActive(true);
        }
        elseif (!$like->getIsActive()) {
            $like->setIsActive(true);
        }
        else {
            $like->setIsActive(false);
        }

        $entityManager->persist($like);
        $entityManager->flush();

        return $this->redirectToRoute('item', array('id' => $id));
    }
}
