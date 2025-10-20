<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use DateTimeImmutable; // Added this line
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

#[Route('/agent')]
final class AgentController extends AbstractController
{
    #[Route('/', name: 'app_agent_index', methods: ['GET'])]
    public function index(AgentRepository $agentRepository): Response
    {
        return $this->render('agent/index.html.twig', [
            'agents' => $agentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_agent_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $agent = new Agent();
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($agent->getDateDebut() === null) {
                $agent->setDateDebut(new \DateTimeImmutable());
            }
            if ($agent->getDateFin() === null) {
                $agent->setDateFin(new \DateTimeImmutable('+1 year')); // Set a default future date
            }
            $entityManager->persist($agent);
            $entityManager->flush();

            return $this->redirectToRoute('app_agent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('agent/new.html.twig', [
            'agent' => $agent,
            'form' => $form,
        ]);
    }

    #[Route('/{matricule}', name: 'app_agent_show', methods: ['GET'])]
    public function show(#[MapEntity(mapping: ['matricule' => 'matricule'])] Agent $agent): Response
    {
        return $this->render('agent/show.html.twig', [
            'agent' => $agent,
        ]);
    }

    #[Route('/{matricule}/edit', name: 'app_agent_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, #[MapEntity(mapping: ['matricule' => 'matricule'])] Agent $agent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_agent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('agent/edit.html.twig', [
            'agent' => $agent,
            'form' => $form,
        ]);
    }

    #[Route('/{matricule}', name: 'app_agent_delete', methods: ['POST'])]
    public function delete(Request $request, #[MapEntity(mapping: ['matricule' => 'matricule'])] Agent $agent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agent->getMatricule(), $request->request->get('_token'))) {
            $entityManager->remove($agent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_agent_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{matricule}/passeports', name: 'app_agent_show_passeports', methods: ['GET'])]
    public function showPasseports(#[MapEntity(mapping: ['matricule' => 'matricule'])] Agent $agent): Response
    {
        return $this->render('agent/show_passeports.html.twig', [
            'agent' => $agent,
            'passeports' => $agent->getPasseports(),
        ]);
    }

    #[Route('/{matricule}/formations', name: 'app_agent_show_formations', methods: ['GET'])]
    public function showFormations(#[MapEntity(mapping: ['matricule' => 'matricule'])] Agent $agent): Response
    {
        return $this->render('agent/show_formations.html.twig', [
            'agent' => $agent,
            'formations' => $agent->getFormations(),
        ]);
    }
}
