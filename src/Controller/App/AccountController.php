<?php

namespace App\Controller\App;

use App\Entity\App\Account;
use App\Form\App\AccountType;
use App\Repository\App\AccountRepository;
use App\Service\AccountService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/app/account")
 */
class AccountController extends AbstractController
{

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * @Route("/", name="app_account_index", methods={"GET"})
     */
    public function index(AccountRepository $accountRepository): Response
    {
        return $this->render('app/account/index.html.twig', [
            'accounts' => $accountRepository->findByUser($this->getUser()),
        ]);
    }

    /**
     * @Route("/new", name="app_account_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $account = new Account();
        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $account->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($account);
            $entityManager->flush();

            return $this->redirectToRoute('app_account_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('app/account/new.html.twig', [
            'account' => $account,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_account_show", methods={"GET"})
     */
    public function show(Account $account): Response
    {
        return $this->render('app/account/show.html.twig', [
            'account' => $account,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_account_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Account $account): Response
    {
        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $account->setModifiedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_account_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('app/account/edit.html.twig', [
            'account' => $account,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_account_delete", methods={"POST"})
     */
    public function delete(Request $request, Account $account): Response
    {
        if ($this->isCsrfTokenValid('delete'.$account->getId(), $request->request->get('_token'))) {
            $this->accountService->setNewCurrentAccount($account);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($account);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_account_index', [], Response::HTTP_SEE_OTHER);
    }
}
