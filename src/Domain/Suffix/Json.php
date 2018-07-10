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

namespace DreadLabs\MediaTypeDecoding\Domain\Suffix;

use DreadLabs\MediaTypeDecoding\Domain\Suffix;

final class Json extends Suffix
{
    public function infer($type): string
    {
        return str_replace((string)$this, '', $type);
    }

    public function __toString(): string
    {
        return '+json';
    }
}
