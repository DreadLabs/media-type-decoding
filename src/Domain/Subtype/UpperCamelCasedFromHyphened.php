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

final class UpperCamelCasedFromHyphened extends Subtype
{
    /**
     * @var Subtype
     */
    private $subtype;

    public function __construct(Subtype $subtype)
    {
        $this->subtype = $subtype;
    }

    public function inferred(array $names): Subtype
    {
        $names = array_map([$this, 'dehyphenate'], $names);

        return new self($this->subtype->inferred($names));
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

    private function dehyphenate(string $name): string
    {
        return preg_replace_callback('/-([a-z])/', [$this, 'uppercase'], ucfirst($name));
    }

    private function uppercase(array $matches): string
    {
        return strtoupper($matches[1]);
    }
}
