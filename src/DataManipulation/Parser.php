<?php declare(strict_types=1);

/*
 * This file is part of Zafkiel.
 *
 * (c) Kévin BENTO <kevin.bento@free.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zafkiel;

interface Parser
{
    public function parse($mode) : ObjectParser;
    public function get()        : string|Array;
}