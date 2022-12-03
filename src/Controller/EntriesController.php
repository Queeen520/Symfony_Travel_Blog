<?php

namespace App\Controller;

use App\Entity\Entries;
use App\Form\EntriesType;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntriesController extends AbstractController
{
    #[Route('/entries', name: 'entries')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entries = $doctrine->getRepository(Entries::class)->findAll();
        // dd($entries);
        return $this->render('entries/index.html.twig', [
            'entries' => $entries
        ]);
    }

    #[Route('/create', name: 'create')]
    public function createEntry(Request $request, ManagerRegistry $doctrine): Response
    {
        $entry = new Entries();
        $form = $this->createForm(EntriesType::class, $entry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $entry = $form->getData();
            $entry->setEntryDate(new \DateTime('now'));

            $doc = $doctrine->getManager();

            $doc->persist($entry);
            $doc->flush();

            return $this->redirectToRoute('entries');
        }


        return $this->render('entries/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/update/{id}', name: 'update')]
    public function updateEntry($id, Request $request, ManagerRegistry $doctrine): Response
    {
        $entry = $doctrine->getRepository(Entries::class)->find($id);
        $form = $this->createForm(EntriesType::class, $entry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $now = new \DateTime('now');
            $entry = $form->getData();
            $entry->setEntryDate($now);
            $em = $doctrine->getManager();
            $em->persist($entry);
            $em->flush();
            $this->addFlash(
                'notice',
                'Entry Edited'
            );

            return $this->redirectToRoute('entries');
        }

        return $this->render('entries/update.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/details/{id}', name: 'details')]
    public function detailsAction($id, ManagerRegistry $doctrine): Response
    {
        $entry = $doctrine->getRepository(Entries::class)->find($id);
        return $this->render('entries/details.html.twig', [
            "entry" => $entry
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function deleteEntry($id, ManagerRegistry $doctrine): Response
    {
        $doc = $doctrine->getManager();
        $entry = $doctrine->getRepository(Entries::class)->find($id);
        $doc->remove($entry);
        $doc->flush();

        return $this->redirectToRoute("entries");
    }
}
