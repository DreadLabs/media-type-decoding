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

final class Prefixed extends Subtype
{
    /**
     * @var Subtype
     */
    private $subtype;

    /**
     * @var array
     */
    private $prefix;

    public function __construct(Subtype $subtype, array $prefix)
    {
        $this->subtype = $subtype;
        $this->prefix = $prefix;
    }

    public function inferred(array $names): Subtype
    {
        return new self($this->subtype->inferred(array_merge($this->prefix, $names)), $this->prefix);
    }

    public function names(): array
    {
        return $this->subtype->names();
    }

    public function glue(): string
    {
        return $this->subtype->glue();
    }

    public function __toString(): string
    {
        return implode($this->glue(), $this->names());
    }
}
