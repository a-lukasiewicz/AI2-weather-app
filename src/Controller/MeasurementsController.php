<?php

namespace App\Controller;

use App\Entity\Measurements;
use App\Form\MeasurementsType;
use App\Repository\MeasurementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/measurements')]
class MeasurementsController extends AbstractController
{
    #[Route('/', name: 'app_measurements_index', methods: ['GET'])]
    #[IsGranted('ROLE_MEASUREMENT')]
    public function index(MeasurementsRepository $measurementsRepository): Response
    {
        return $this->render('measurements/index.html.twig', [
            'measurements' => $measurementsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_measurements_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_MEASUREMENT_CREATE')]
    public function new(Request $request, MeasurementsRepository $measurementsRepository): Response
    {
        $measurement = new Measurements();
        $form = $this->createForm(MeasurementsType::class, $measurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $measurementsRepository->save($measurement, true);

            return $this->redirectToRoute('app_measurements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('measurements/new.html.twig', [
            'measurement' => $measurement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_measurements_show', methods: ['GET'])]
    #[IsGranted('ROLE_MEASUREMENT_SHOW')]
    public function show(Measurements $measurement): Response
    {
        return $this->render('measurements/show.html.twig', [
            'measurement' => $measurement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_measurements_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_MEASUREMENT_EDIT')]
    public function edit(Request $request, Measurements $measurement, MeasurementsRepository $measurementsRepository): Response
    {
        $form = $this->createForm(MeasurementsType::class, $measurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $measurementsRepository->save($measurement, true);

            return $this->redirectToRoute('app_measurements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('measurements/edit.html.twig', [
            'measurement' => $measurement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_measurements_delete', methods: ['POST'])]
    #[IsGranted('ROLE_MEASUREMENT_DELETE')]
    public function delete(Request $request, Measurements $measurement, MeasurementsRepository $measurementsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $measurement->getId(), $request->request->get('_token'))) {
            $measurementsRepository->remove($measurement, true);
        }

        return $this->redirectToRoute('app_measurements_index', [], Response::HTTP_SEE_OTHER);
    }
}
