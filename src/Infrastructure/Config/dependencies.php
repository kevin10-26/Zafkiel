<?php

declare(strict_types=1);

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use Zafkiel\Domain\Interfaces\Services\AdminServiceInterface;
use Zafkiel\Domain\Interfaces\Services\AppsServiceInterface;
use Zafkiel\Domain\Interfaces\Services\AuthServiceInterface;
use Zafkiel\Domain\Interfaces\Services\SessionManagerServiceInterface;
use Zafkiel\Domain\Interfaces\iCache;

use Zafkiel\Infrastructure\Services\AuthService;
use Zafkiel\Infrastructure\Services\SlideshowService;
use Zafkiel\Infrastructure\Services\AppsService;
use Zafkiel\Infrastructure\Services\LoggerService;
use Zafkiel\Infrastructure\Services\AdminService;
use Zafkiel\Infrastructure\Services\SessionManagerService;

use Zafkiel\Application\UseCases\Admin\UploadPictureUseCase;

use Zafkiel\Infrastructure\Persistence\PictureFileRepository;
use Zafkiel\Infrastructure\Persistence\PictureDoctrineRepository;
use Zafkiel\Infrastructure\Persistence\AdminDoctrineRepository;
use Zafkiel\Infrastructure\Persistence\AdminFileRepository;

use Zafkiel\Infrastructure\Cache\RedisClient;

use Zafkiel\Presentation\Middleware\AuthMiddleware;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;

return [
    // Configuration de Twig
    FilesystemLoader::class => function () {
        return new FilesystemLoader(__DIR__ . '/../../Presentation/Templates');
    },

    Environment::class => function (FilesystemLoader $loader) {
        $twig = new Environment($loader, [
            'cache' => __DIR__ . '/../../../var/cache/twig',
            'auto_reload' => true,
            'debug' => $_ENV['APP_ENV'] === 'dev'
        ]);

        // Ajout de la fonction dump simplifiée
        $twig->addFunction(new \Twig\TwigFunction('dump', function ($var) {
            return '<pre>' . htmlspecialchars(print_r($var, true)) . '</pre>';
        }));

        return $twig;
    },

    // Service de logging
    LoggerService::class => function () {
        $logger = new Logger('zafkiel');

        // Création du dossier de logs s'il n'existe pas
        $logDir = __DIR__ . '/../../../var/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        // Configuration du handler avec rotation
        $handler = new RotatingFileHandler(
            $logDir . '/app.log',  // Chemin du fichier de log
            7,                     // Nombre maximum de fichiers à conserver
            Logger::DEBUG,         // Niveau de log minimum
            true,                  // Utiliser le verrouillage de fichier
            0664                   // Permissions du fichier
        );

        // Format du message de log
        $handler->setFilenameFormat('{filename}-{date}', 'Y-m-d');

        $logger->pushHandler($handler);

        return new LoggerService($logger);
    },

    // Configuration de la connexion Redis pour le cache
    RedisClient::class => function () {
        $host = $_ENV['REDIS_HOST'] ?? 'localhost';
        $port = (int) ($_ENV['REDIS_PORT'] ?? 6379);
        $password = $_ENV['REDIS_PASSWORD'] ?? null;
        $database = (int) ($_ENV['REDIS_DATABASE'] ?? 0);
        
        return new RedisClient($host, $port, $password, $database);
    },
    
    // Alias de l'interface iCache vers l'implémentation RedisClient
    iCache::class => function (\Psr\Container\ContainerInterface $c) {
        return $c->get(RedisClient::class);
    },

    // Configuration du service de gestion des sessions
    SessionManagerService::class => function (\Psr\Container\ContainerInterface $c) {
        return new SessionManagerService(
            $c->get(iCache::class),
            $c->get(AdminDoctrineRepository::class)
        );
    },
    
    // Alias de l'interface vers l'implémentation
    SessionManagerServiceInterface::class => function (\Psr\Container\ContainerInterface $c) {
        return $c->get(SessionManagerService::class);
    },

    // Configuration de la connexion à la base de données Doctrine DBAL
    DriverManager::class => function () {
        $dbParams = [
            'driver' => 'pdo_mysql',
            'host' => $_ENV['DB_HOST'] ?? 'localhost',
            'port' => (int) ($_ENV['DB_PORT'] ?? 3306),
            'dbname' => $_ENV['DB_NAME'] ?? 'zafkiel',
            'user' => $_ENV['DB_USER'] ?? 'kevin',
            'password' => $_ENV['DB_PASSWORD'] ?? '',
            'charset' => 'utf8mb4'
        ];

        return DriverManager::getConnection($dbParams);
    },

    // Configuration de l'EntityManager Doctrine ORM
    EntityManager::class => function (\Psr\Container\ContainerInterface $c) {
        $paths = [__DIR__ . '/../../Domain/Entities'];
        $isDevMode = $_ENV['APP_ENV'] === 'dev';

        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

        return new EntityManager($c->get(DriverManager::class), $config);
    },

    // Alias de l'interface vers l'implémentation
    EntityManagerInterface::class => function (\Psr\Container\ContainerInterface $c) {
        return $c->get(EntityManager::class);
    },

    // Configuration du service Admin
    AdminService::class => function (\Psr\Container\ContainerInterface $c) {
        return new AdminService(
            $c->get(EntityManagerInterface::class),
            $c->get(AdminDoctrineRepository::class),
            $c->get(AdminFileRepository::class)
        );
    },

    // Alias de l'interface vers l'implémentation
    AdminServiceInterface::class => function (\Psr\Container\ContainerInterface $c) {
        return $c->get(AdminService::class);
    },

    // Configuration du service Admin
    AppsService::class => function (\Psr\Container\ContainerInterface $c) {
        return new AppsService($c->get(EntityManagerInterface::class));
    },

    // Alias de l'interface vers l'implémentation
    AppsServiceInterface::class => function (\Psr\Container\ContainerInterface $c) {
        return $c->get(AppsService::class);
    },

    // Configuration du service AuthMiddleware
    AuthMiddleware::class => function (\Psr\Container\ContainerInterface $c) {
        // Assurez-vous que la variable d'environnement PUBLIC_KEY_PATH est définie.
        $publicKeyPath = $_ENV['PUBLIC_KEY_PATH'] ?? null;
        $privateKeyPath = $_ENV['PRIVATE_KEY_PATH'] ?? null;

        if (is_null($publicKeyPath) xor is_null($privateKeyPath)) {
            throw new \Exception("La variable d'environnement PUBLIC_KEY_PATH n'est pas définie.");
        }

        $privateKeyPassPhrase = $_ENV['PRIVATE_KEY_PASSPHRASE'] ?? null;

        return new AuthMiddleware($privateKeyPath, $privateKeyPassPhrase, $publicKeyPath);
    },

    // Configuration du service Auth
    AuthService::class => function (\Psr\Container\ContainerInterface $c) {
        return new AuthService(
            $c->get(EntityManagerInterface::class), 
            $c->get(AuthMiddleware::class),
            $c->get(SessionManagerService::class)
        );
    },

    // Alias de l'interface vers l'implémentation
    AuthServiceInterface::class => function (\Psr\Container\ContainerInterface $c) {
        return $c->get(AuthService::class);
    },

    // UploadPictureUseCase UseCase's config.
    UploadPictureUseCase::class => function (\Psr\Container\ContainerInterface $c) {
        return new UploadPictureUseCase(
            $c->get(SlideshowService::class)
        );
    },

    // UploadPictureUseCase UseCase's config.
    FetchPicturesUseCase::class => function (\Psr\Container\ContainerInterface $c) {
        return new FetchPicturesUseCase(
            $c->get(SlideshowService::class)
        );
    },

    SlideshowService::class => function(\Psr\Container\ContainerInterface $c) {
        return new SlideshowService(
            $c->get(PictureFileRepository::class),
            $c->get(PictureDoctrineRepository::class)
        );
    }
];
