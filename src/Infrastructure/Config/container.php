<?php

declare(strict_types=1);

use DI\ContainerBuilder;

$builder = new ContainerBuilder();

// Charger la configuration de base
$builder->addDefinitions(__DIR__ . '/dependencies.php');

// Configurer l'auto-discovery
$builder->useAutowiring(true);

return $builder->build();
