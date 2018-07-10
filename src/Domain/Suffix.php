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

abstract class Suffix
{
    final public static function none(): Suffix
    {
        return new class extends Suffix {
            public function __toString(): string
            {
                return '';
            }

            public function infer($type): string
            {
                return $type;
            }
        };
    }

    abstract public function infer($type): string;

    abstract public function __toString(): string;
}
