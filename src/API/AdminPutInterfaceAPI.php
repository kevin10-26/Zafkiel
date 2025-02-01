<?php declare(strict_types=1);

namespace Zafkiel\API;

class AdminPutInterfaceAPI
{
    public function pushSlideshowPictures(
        array $adminFile,
        string $targetedAdmin,
        array $paths
    ) : array
    {
        $adminFile[$targetedAdmin]['additionnal_data']['preferences']['backgroundPictures'] = $paths;

        return $adminFile;
    }
}