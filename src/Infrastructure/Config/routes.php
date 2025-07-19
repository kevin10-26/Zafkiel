<?php

declare(strict_types=1);

use FastRoute\RouteCollector;
use Zafkiel\Presentation\Controllers\HomeController;
use Zafkiel\Infrastructure\Services\LoggerService;
use Zafkiel\Presentation\Controllers\AuthController;
use Zafkiel\Presentation\Controllers\SlideshowController;
use Zafkiel\Presentation\Controllers\AdminController;

return function (RouteCollector $r) {

    $r->addRoute('GET', '/', [HomeController::class, 'index']);

    // Token refresh route
    $r->post('/auth/refresh', [AuthController::class, 'refreshToken']);

    // API des utilisateurs en ligne
    $r->addRoute('GET', '/admin/online-admins', [AdminController::class, 'getOnlineAdmins']);

    // Fetch admins route
    $r->post('/admin/fetchAdminDetails', [AdminController::class, 'fetchAdminDetails']);

    // Fetch danger zone route
    $r->post('/admin/fetchDangerZone', [AdminController::class, 'fetchDangerZone']);

    // Fetch slideshow pictures route
    $r->post('/slideshow/fetchPictures', [SlideshowController::class, 'fetchPictures']);

    // Update slideshow pictures route
    $r->put('/slideshow/updateSlideshowPictures', [SlideshowController::class, 'updateSlideshowPictures']);

    // Upload new picture
    $r->post('/slideshow/uploadNewPicture',  [SlideshowController::class, 'uploadSlideshowPicture']);

    // Delete picture
    $r->delete('/slideshow/deletePicture',  [SlideshowController::class, 'deletePicture']);

    // Upload profile picture
    $r->post('/admin/uploadProfilePicture', [AdminController::class, 'uploadProfilePicture']);

    // Update admin profile
    $r->put('/admin/updateAdminProfile', [AdminController::class, 'updateAdminProfile']);
};
