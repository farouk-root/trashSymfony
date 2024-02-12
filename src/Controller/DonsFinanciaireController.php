<?php

namespace App\Controller;

use App\Entity\DonsFinanciaire;
use App\Form\DonsFinanciaireType;
use App\Repository\DonsFinanciaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dons/financiaire')]
class DonsFinanciaireController extends AbstractController
{
    #[Route('/', name: 'app_dons_financiaire_index', methods: ['GET'])]
    public function index(DonsFinanciaireRepository $donsFinanciaireRepository): Response
    {
        return $this->render('dons_financiaire/index.html.twig', [
            'dons_financiaires' => $donsFinanciaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dons_financiaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $donsFinanciaire = new DonsFinanciaire();
        $form = $this->createForm(DonsFinanciaireType::class, $donsFinanciaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($donsFinanciaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_dons_financiaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dons_financiaire/new.html.twig', [
            'dons_financiaire' => $donsFinanciaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dons_financiaire_show', methods: ['GET'])]
    public function show(DonsFinanciaire $donsFinanciaire): Response
    {
        return $this->render('dons_financiaire/show.html.twig', [
            'dons_financiaire' => $donsFinanciaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dons_financiaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DonsFinanciaire $donsFinanciaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DonsFinanciaireType::class, $donsFinanciaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dons_financiaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dons_financiaire/edit.html.twig', [
            'dons_financiaire' => $donsFinanciaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dons_financiaire_delete', methods: ['POST'])]
    public function delete(Request $request, DonsFinanciaire $donsFinanciaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$donsFinanciaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($donsFinanciaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dons_financiaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
