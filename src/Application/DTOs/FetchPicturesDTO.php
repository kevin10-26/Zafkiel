<?php declare(strict_types=1);

namespace Zafkiel\Application\DTOs;

use Zafkiel\Application\DTOs\AdminDTO;

class FetchPicturesDTO
{
    // Selected by the user
    public array $selectedPictures = array(
        'obj' => array(),
        'paths' => array()
    );

    // Generally refered as 'all' pictures
    public array $contextPictures = array(
        'default' => array(),
        'private' => array()
    );
    
    public function __construct(
        public int $adminId,
        public bool $userPicturesOnly
    ) {}
}