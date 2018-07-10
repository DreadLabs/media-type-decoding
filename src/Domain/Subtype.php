<?php
declare(strict_types=1);

/*
 * This file is part of the `dreadlabs/media-type-decoding` package.
 *
 * (c) 2017,2018 Thomas Juhnke <dev@van-tomas.de>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace DreadLabs\MediaTypeDecoding\Domain;

abstract class Subtype
{
    abstract public function inferred(array $names): Subtype;

    abstract public function names(): array;

    abstract public function glue(): string;

    abstract public function __toString(): string;
}
