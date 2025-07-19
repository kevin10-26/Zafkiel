<?php

declare(strict_types=1);

namespace Zafkiel\Presentation\Controllers;

use Twig\Environment;

use Zafkiel\Application\UseCases\Admin\UploadPictureUseCase;
use Zafkiel\Application\UseCases\Admin\UpdateSlideshowUseCase;
use Zafkiel\Application\UseCases\Admin\FetchPicturesUseCase;
use Zafkiel\Application\UseCases\Admin\DeletePictureUseCase;

use Zafkiel\Application\DTOs\UploadPictureDTO;
use Zafkiel\Application\DTOs\UpdateSlideshowDTO;
use Zafkiel\Application\DTOs\FetchPicturesDTO;
use Zafkiel\Application\DTOs\DeletePictureDTO;

use Zafkiel\Infrastructure\Services\AuthService;

use Sabre\HTTP\Response;
use Sabre\HTTP\Sapi;

class SlideshowController
{
    public function __construct(
        private readonly Environment $twig,
        private AuthService $authService,
        private UploadPictureUseCase $uploadPictures,
        private UpdateSlideshowUseCase $updateSlideshow,
        private FetchPicturesUseCase $fetchPictures,
        private DeletePictureUseCase $deletePicture
    ) {}

    public function fetchPictures(): Response
    {
        $request = Sapi::getRequest();
        $userPicturesOnly = json_decode($request->getBodyAsString(), true)['onlyUserPictures'] ?? false;

        $adminId = $this->authService->getDecodedToken()['adminId'];

        $twigTemplate = ($userPicturesOnly) ? 'admin_user_pictures.twig' : 'admin_slideshow_preferences.twig';

        $dto = new FetchPicturesDTO($adminId, $userPicturesOnly);
        $this->fetchPictures->execute($dto);

        $data = [
            'selectedPictures' => $dto->selectedPictures
        ];

        ($userPicturesOnly) ? 
            $data['privatePictures'] = $dto->contextPictures['private'] :
            $data['pictures'] = $dto->contextPictures;

        $response = new Response(200);
        $response->setHeader('Content-Type', 'text/html');
        $response->setBody($this->twig->render('components/settings/' . $twigTemplate, $data));

        return $response;
    }

    public function updateSlideshowPictures(): Response
    {
        $data = json_decode(Sapi::getRequest()->getBodyAsString(), true);

        $adminId = $this->authService->getDecodedToken()['adminId'];
        $dto = new UpdateSlideshowDTO($adminId, $data['pictures']);

        $update = $this->updateSlideshow->execute($dto);

        if ($update) {
            $response = new Response(200);
            $response->setHeader('Content-Type', 'application/json');
            $response->setBody(json_encode([
                'status' => 'success',
                'message' => 'Slideshow pictures updated successfully',
                'data' => [
                    'pictures' => $data['pictures'] ?? []
                ]
            ]));
        } else {
            $response = new Response(500);
            $response->setHeader('Content-Type', 'application/json');
            $response->setBody(json_encode([
                'status' => 'error',
                'message' => 'Failed to update slideshow pictures',
                'error' => 'Database update failed'
            ]));
        }

        return $response;
    }

    public function uploadSlideshowPicture(): Response
    {
        if (empty($_FILES)) {
            // Return error
        }

        $adminId = $this->authService->getDecodedToken()['adminId'];
        $data = $_FILES['picture'];

        $upload = $this->uploadPictures->execute(new UploadPictureDTO($adminId, $data));

        if ($upload)
        {
            $response = new Response(200);
            $response->setHeader('Content-Type', 'application/json');
            $response->setBody(json_encode([
                'status' => 'success',
                'message' => 'New picture updated successfully',
                'data' => [
                    'pictures' => $data
                ]
            ]));

        } else 
        {
            $response = new Response(500);
            $response->setHeader('Content-Type', 'application/json');
            $response->setBody(json_encode([
                'status' => 'error',
                'message' => 'Failed to update your picture',
                'error' => 'Database update failed'
            ]));
        }

        return $response;
    }

    public function deletePicture(): Response
    {
        $request = Sapi::getRequest();
        $picturePath = json_decode($request->getBodyAsString(), true)['picture'] ?? '';

        $adminId = $this->authService->getDecodedToken()['adminId'];
        $dto = new DeletePictureDTO($adminId, $picturePath);

        $delete = $this->deletePicture->execute($dto);

        if ($delete) {
            $response = new Response(200);
            $response->setHeader('Content-Type', 'application/json');
            $response->setBody(json_encode([
                'status' => 'success',
                'message' => 'Picture deleted successfully',
                'data' => [
                    'picture' => $picturePath
                ]
            ]));
        } else {
            $response = new Response(500);
            $response->setHeader('Content-Type', 'application/json');
            $response->setBody(json_encode([
                'status' => 'error',
                'message' => 'Failed to delete picture',
                'error' => 'Database delete failed'
            ]));
        }

        return $response;
    }
}
