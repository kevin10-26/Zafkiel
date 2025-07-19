<?php declare(strict_types=1);

namespace Zafkiel\Presentation\Controllers;

use Zafkiel\Infrastructure\Services\AuthService;
use Zafkiel\Infrastructure\Services\LoggerService;

use Zafkiel\Application\UseCases\Admin\SetAdminProfilePictureUseCase;
use Zafkiel\Application\UseCases\Admin\SetAdminDataProfileUseCase;
use Zafkiel\Application\UseCases\Admin\FetchAdminDataProfileUseCase;

use Zafkiel\Application\DTOs\SetAdminProfilePictureDTO;
use Zafkiel\Application\DTOs\SetAdminDataProfileDTO;
use Zafkiel\Application\DTOs\FetchAdminDetailsDTO;

use Sabre\HTTP\Response;
use Sabre\HTTP\Sapi;

use Twig\Environment;

class AdminController
{    
    public function __construct(
        private AuthService $authService,
        private SetAdminProfilePictureUseCase $setAdminProfilePictureUseCase,
        private SetAdminDataProfileUseCase $setAdminDataProfileUseCase,
        private FetchAdminDataProfileUseCase $fetchAdminDataProfileUseCase,
        private Environment $twig
    ) {}

    public function uploadProfilePicture()
    {
        $profilePicture = $_FILES;

        $adminId = $this->authService->getDecodedToken()['adminId'];
        $dto = new SetAdminProfilePictureDTO($adminId, $profilePicture['picture']);

        $dto->picturePath = 'img/admins/' . $adminId . '/profile_pictures/';
        
        $updatedProfilePicture = $this->setAdminProfilePictureUseCase->execute($dto);

        if ($updatedProfilePicture) {
            $response = new Response(200);
            $response->setHeader('Content-Type', 'application/json');
            $response->setBody(json_encode([
                'status' => 'success',
                'message' => 'Profile picture updated successfully',
                'data' => [
                    'picture' => $updatedProfilePicture
                ]
            ]));
        } else {
            $response = new Response(500);
            $response->setHeader('Content-Type', 'application/json');
            $response->setBody(json_encode([
                'status' => 'error',
                'message' => 'Failed to update profile picture',
                'error' => 'Database update failed'
            ]));
        }

        return $response;

    }

    public function updateAdminProfile()
    {   
        $request = json_decode(Sapi::getRequest()->getBodyAsString(), true);
        $adminId = $this->authService->getDecodedToken()['adminId'];
        $dto = new SetAdminDataProfileDTO($adminId, $request);

        $updatedAdminData = $this->setAdminDataProfileUseCase->execute($dto);

        if ($updatedAdminData) {
            $response = new Response(200);
            $response->setHeader('Content-Type', 'application/json');
            $response->setBody(json_encode([
                'status' => 'success',
                'message' => 'Admin profile updated successfully',
                'data' => [
                    'fieldToUpdate' => $request['fieldToUpdate'],
                    'value' => $request['value']
                ]
            ]));
        } else {
            $response = new Response(500);
            $response->setHeader('Content-Type', 'application/json');
            $response->setBody(json_encode([
                'status' => 'error',
                'message' => 'Failed to update admin profile',
                'error' => 'Database update failed'
            ]));
        }

        return $response;
    }

    public function fetchAdminDetails()
    {
        $request = json_decode(Sapi::getRequest()->getBodyAsString(), true);
        $adminId = $this->authService->getDecodedToken()['adminId'];
        $dto = new FetchAdminDetailsDTO($adminId);

        $updatedAdminData = $this->fetchAdminDataProfileUseCase->execute($dto);

        $data = [
            'admin' => $updatedAdminData[$adminId]
        ];

        $response = new Response(200);
        $response->setHeader('Content-Type', 'text/html');
        $response->setBody($this->twig->render('components/monitoring/AdminViewer.twig', $data));

        return $response;
    }

    public function fetchDangerZone()
    {
        
    }
}