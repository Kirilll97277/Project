<?php

namespace App\Controller\Admin;

use App\Entity\Collection;
use App\Entity\Theme;
use App\Form\ThemeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ThemeController extends AbstractController
{
    #[Route('/admin/theme', name: 'admin_theme')]
    public function index(): Response
    {
        $theme = $this->getDoctrine()->getRepository(Theme::class)->findAll();
        return $this->render('admin/theme/index.html.twig', array(
            'themes' => $theme,
            'title'=> 'Themes'
        ));
    }

    #[Route('/admin/theme/add', name: 'admin_add_theme')]
    public function addTag(Request $request, EntityManagerInterface $entityManager): Response
    {
        $theme = new Theme();
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($theme);
            $entityManager->flush();

            return $this->redirectToRoute('admin_theme');
        }
        $forRender['title'] = 'theme creation';
        $forRender['addthemeForm'] = $form->createView();
        return $this->render('admin/theme/form.html.twig', $forRender);
    }
}
