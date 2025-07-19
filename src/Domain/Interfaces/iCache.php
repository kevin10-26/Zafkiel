<?php declare(strict_types=1);

namespace Zafkiel\Domain\Interfaces;

interface iCache
{
    /**
     * Récupère une valeur du cache
     *
     * @param string $key Clé de cache
     * @return mixed|null Valeur stockée ou null si absente
     */
    public function get(string $key): mixed;

    /**
     * Stocke une valeur dans le cache avec une durée de vie optionnelle
     *
     * @param string $key Clé de cache
     * @param mixed $data Données à stocker
     * @param int $ttl Durée de vie en secondes (0 = infini)
     * @return bool Succès de l'opération
     */
    public function set(string $key, mixed $data, int $ttl = 3600): bool;

    /**
     * Supprime une entrée du cache
     *
     * @param string $key Clé de cache
     * @return bool Succès de l'opération
     */
    public function delete(string $key): bool;
    
    /**
     * Vérifie si une clé existe dans le cache
     *
     * @param string $key Clé de cache
     * @return bool True si la clé existe
     */
    public function exists(string $key): bool;
    
    /**
     * Ajoute une valeur à un ensemble trié avec un score
     *
     * @param string $key Clé de l'ensemble trié
     * @param mixed $value Valeur à ajouter
     * @param float $score Score de la valeur
     * @return bool Succès de l'opération
     */
    public function zAdd(string $key, mixed $value, float $score): bool;
    
    /**
     * Supprime une valeur d'un ensemble trié
     *
     * @param string $key Clé de l'ensemble trié
     * @param mixed $value Valeur à supprimer
     * @return bool Succès de l'opération
     */
    public function zRem(string $key, mixed $value): bool;
    
    /**
     * Récupère les valeurs d'un ensemble trié par intervalle de score
     *
     * @param string $key Clé de l'ensemble trié
     * @param float $min Score minimum
     * @param float $max Score maximum
     * @return array Valeurs dans l'intervalle
     */
    public function zRangeByScore(string $key, float $min, float $max): array;
    
    /**
     * Supprime les valeurs d'un ensemble trié par intervalle de score
     *
     * @param string $key Clé de l'ensemble trié
     * @param float $min Score minimum
     * @param float $max Score maximum
     * @return int Nombre d'éléments supprimés
     */
    public function zRemRangeByScore(string $key, float $min, float $max): int;
    
    /**
     * Exécute un script Lua sur le serveur Redis
     *
     * @param string $script Code du script Lua
     * @param array $keys Clés utilisées dans le script
     * @param array $args Arguments du script
     * @return mixed Résultat du script
     */
    public function eval(string $script, array $keys = [], array $args = []): mixed;
    
    /**
     * Incrémente la valeur d'une clé
     *
     * @param string $key Clé à incrémenter
     * @param int $value Valeur à ajouter
     * @return int Nouvelle valeur
     */
    public function increment(string $key, int $value = 1): int;
    
    /**
     * Définit une date d'expiration pour une clé
     *
     * @param string $key Clé de cache
     * @param int $ttl Durée de vie en secondes
     * @return bool Succès de l'opération
     */
    public function expire(string $key, int $ttl): bool;
}