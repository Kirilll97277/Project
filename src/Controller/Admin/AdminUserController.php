<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class AdminUserController extends AbstractController
{
    #[Route('admin/user', name: 'admin_user')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render('admin/user/index.html.twig', array(
            'users' => $users,
            'title' => 'Users'
        ));
    }

    #[Route('user/delete', name: 'user_delete')]
    public function deleteUsers(
        Request $request,
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage
    ): JsonResponse {
        $ids = json_decode($request->getContent(), true)['ids'];
        $doctrine = $entityManager;
        $users = $doctrine->getRepository(User::class)->findBy(['id' => $ids]);
        $redirect = false;
        try{
            foreach ($users as $user) {
                $doctrine->remove($user);
            }
            $doctrine->flush();

            return new JsonResponse(json_encode(['success' => true, 'redirect' => $redirect]));

        } catch (\Exception $exception)
        {
            return new JsonResponse(json_encode(['success' => false]));
        }
    }

    #[Route('user/block', name: 'user_block')]
    public function blockUsers(
        Request $request,
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage
    ): JsonResponse {
        $ids = json_decode($request->getContent(), true)['ids'];
        $doctrine = $entityManager;
        $users = $doctrine->getRepository(User::class)->findBy(['id' => $ids]);
        $redirect = false;

        try{
            foreach ($users as $user) {
                $user->setIsActive(false);
            }
            $doctrine->flush();

            return new JsonResponse(json_encode(['success' => true, 'redirect' => $redirect]));

        } catch (\Exception $exception)
        {
            return new JsonResponse(json_encode(['success' => false]));
        }
    }

    #[Route('user/unblock', name: 'user_unblock')]
    public function unblockUsers(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $ids = json_decode($request->getContent(), true)['ids'];
        $doctrine = $entityManager;
        $users = $doctrine->getRepository(User::class)->findBy(['id' => $ids]);

        try{
            foreach ($users as $user) {
                $user->setIsActive(true);
            }
            $doctrine->flush();

            return new JsonResponse(json_encode(['success' => true]));

        } catch (\Exception $exception)
        {
            return new JsonResponse(json_encode(['success' => false]));
        }
    }

    #[Route('user/addAdmin', name: 'user_add_admin')]
    public function addRoleAdmin(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $ids = json_decode($request->getContent(), true)['ids'];
        $doctrine = $entityManager;
        $users = $doctrine->getRepository(User::class)->findBy(['id' => $ids]);

        try{
            foreach ($users as $user) {
                $user->setRoles(["ROLE_ADMIN"]);
            }
            $doctrine->flush();

            return new JsonResponse(json_encode(['success' => true]));

        } catch (\Exception $exception)
        {
            return new JsonResponse(json_encode(['success' => false]));
        }
    }

    #[Route('user/deleteAdmin', name: 'user_delete_admin')]
    public function deleteRoleAdmin(Request $request,
                                    EntityManagerInterface $entityManager): JsonResponse
    {
        $ids = json_decode($request->getContent(), true)['ids'];
        $doctrine = $entityManager;
        $users = $doctrine->getRepository(User::class)->findBy(['id' => $ids]);

        try{
            foreach ($users as $user) {
                $user->setRoles(["ROLE_USER"]);
            }
            $doctrine->flush();

            return new JsonResponse(json_encode(['success' => true]));

        } catch (\Exception $exception)
        {
            return new JsonResponse(json_encode(['success' => false]));
        }
    }
}
