<?php

declare(strict_types=1);

namespace Zafkiel\Presentation\Controllers;

use Sabre\HTTP\Response;
use Twig\Environment;

use Zafkiel\Application\DTOs\FetchAdminDetailsDTO;
use Zafkiel\Application\UseCases\Admin\GetAdminDetailsUseCase;
use Zafkiel\Application\UseCases\Admin\FetchSlideshowUseCase;
use Zafkiel\Application\UseCases\Apps\GetAppsDetailsUseCase;

use Zafkiel\Infrastructure\Services\LoggerService;
use Zafkiel\Infrastructure\Services\AuthService;

class HomeController
{
    public function __construct(
        private readonly LoggerService $logger,
        private readonly Environment $twig,
        private readonly GetAdminDetailsUseCase $getAdminDetailsUseCase,
        private readonly GetAppsDetailsUseCase $getAppsDetailsUseCase,
        private readonly FetchSlideshowUseCase $fetchSlideshowUseCase
    ) {}

    public function index(): Response
    {
        try {

            $dto = new FetchAdminDetailsDTO(1);
            
            $adminsDetails = $this->getAdminDetailsUseCase->execute($dto);
            $appsDetails = $this->getAppsDetailsUseCase->execute($dto);
            $jwtToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c';

            $response = new Response();
            $response->setBody($this->twig->render('home/zafkiel_desktop.twig', [
                'admins' => $adminsDetails,
                'loggedAdmin' => $adminsDetails[$dto->adminId],
                'apps' => $appsDetails,
                'jwtToken' => $jwtToken
            ]));

            return $response;
        } catch (\Exception $e) {
            $this->logger->error('Erreur dans HomeController::index: ' . $e->getMessage());
            throw $e;
        }
    }
}
