<?php

namespace App\Controller\App;

use App\Entity\App\Project;
use App\Form\App\ProjectType;
use App\Repository\App\ProjectRepository;
use App\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/app/project")
 */
class ProjectController extends AbstractController
{

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @Route("/", name="app_project_index", methods={"GET"})
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        $user = $this->getUser();
        return $this->render('app/project/index.html.twig', [
            'projects' => $projectRepository->findByUser($user),
            'current' => $user->getCurrentProject()
        ]);
    }

    /**
     * @Route("/current", name="app_project_current", methods={"POST"})
     */
    public function current(Request $request, ProjectRepository $projectRepository): JsonResponse
    {
        $user    = $this->getUser();
        $id      = $request->request->get('project');
        $project = $projectRepository->findOneById($id);

        $user->setCurrentProject($project);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse([
            'success' => true,
        ]);
    }

    /**
     * @Route("/new", name="app_project_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->projectService->addProject($project);
            
            return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('app/project/new.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_project_show", methods={"GET"})
     */
    public function show(Project $project): Response
    {
        return $this->render('app/project/show.html.twig', [
            'project' => $project,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_project_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Project $project): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $project->setModifiedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('app/project/edit.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_project_delete", methods={"POST"})
     */
    public function delete(Request $request, Project $project): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
    }

}
