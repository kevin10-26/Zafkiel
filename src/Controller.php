<?php

declare(strict_types=1);

namespace Kevin1026;

use Zafkiel\Core\Factory;
use Zafkiel\Desktop\Generator;

class Controller
{
    private string $_session;
    private array $_routesConfig;

    public array $modules = [
        'items' => array(
            'posts'     => array(
                'name'   => 'Statistiques',
                'path'   => 'posts.jpg',
                'pinned' => true,
                'data'   => array('foo' => "bar")
            ),
            'comments'     => array(
                'name'   => 'Gestion des logements',
                'path'   => 'comments.png',
                'pinned' => true,
                'data'   => array()
            ),
            'announces'     => array(
                'name'   => 'Gestion des avis',
                'path'   => 'announces.avif',
                'pinned' => false,
                'data'   => array()
            ),
        ),
        'moduleIconsPath' => '/public/img/backoffice/modules/'
    ];

    public function __construct(string $session)
    {
        $this->_session      = $session;
        $this->_routesConfig = $this->_getRoutes();
    }

    public function show()
    {
        $factory = new Factory($this->modules, __DIR__ . '/Templates/');

        $factory->importHTML('posts.html');

        return $this->exec($factory);
    }

    private function _getRoutes()
    {
        return json_decode(file_get_contents('./src/config/config_routes.json'), true);
    }

    private function exec($factory)
    {
        $desktop = new Generator($this->_routesConfig, $factory, $this->_session);

        return $desktop->generate($this->modules);
    }
}
