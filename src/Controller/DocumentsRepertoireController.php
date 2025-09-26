<?php

namespace App\Controller;

use App\Entity\DocumentsRepertoire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/documents')]
#[IsGranted('ROLE_USER')] // Restrict access to authenticated users
class DocumentsRepertoireController extends AbstractController
{
    #[Route('/download/{id}', name: 'app_document_download')]
    public function download(DocumentsRepertoire $document): Response
    {
        $filePath = $this->getParameter('kernel.project_dir') . '/public/uploads/documents/' . $document->getCheminFichier();

        if (!file_exists($filePath)) {
            throw $this->createNotFoundException('The document does not exist.');
        }

        return $this->file($filePath, $document->getNomFichier(), ResponseHeaderBag::DISPOSITION_ATTACHMENT);
    }

    #[Route('/view/{id}', name: 'app_document_view')]
    public function view(DocumentsRepertoire $document): Response
    {
        $filePath = $this->getParameter('kernel.project_dir') . '/public/uploads/documents/' . $document->getCheminFichier();

        if (!file_exists($filePath)) {
            throw $this->createNotFoundException('The document does not exist.');
        }

        // Check if it's an image
        if (str_starts_with($document->getTypeMime(), 'image/')) {
            return new Response(file_get_contents($filePath), 200, [
                'Content-Type' => $document->getTypeMime(),
                'Content-Disposition' => 'inline; filename="' . $document->getNomFichier() . '"'
            ]);
        } else {
            // For non-image files, redirect to download or show a message
            return $this->redirectToRoute('app_document_download', ['id' => $document->getId()]);
        }
    }
}
