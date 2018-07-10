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

namespace DreadLabs\MediaTypeDecoding\Domain\Subtype;

use DreadLabs\MediaTypeDecoding\Domain\Subtype;

final class Imploded extends Subtype
{
    /**
     * @var string
     */
    private $glue;

    /**
     * @var array
     */
    private $names;

    public function __construct(string $glue)
    {
        $this->glue = $glue;
    }

    public function inferred(array $names): Subtype
    {
        $subtype = clone $this;
        $subtype->names = $names;

        return $subtype;
    }

    public function names(): array
    {
        return $this->names;
    }

    public function glue(): string
    {
        return $this->glue;
    }

    public function __toString(): string
    {
        return implode($this->glue(), $this->names());
    }
}
