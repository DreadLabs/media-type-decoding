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

final class RegistrationTree
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * @var Subtype
     */
    private $subtype;

    /**
     * @var string
     */
    private $delimiter;

    public static function standard(Subtype $subtype): RegistrationTree
    {
        return new self('', $subtype, '-');
    }

    public static function vendor(Subtype $subtype): RegistrationTree
    {
        return new self('vnd', $subtype, '.');
    }

    public static function personal(Subtype $subtype): RegistrationTree
    {
        return new self('prs', $subtype, '.');
    }

    public static function vanity(Subtype $subtype): RegistrationTree
    {
        return self::personal($subtype);
    }

    public static function unregistered(Subtype $subtype): RegistrationTree
    {
        return new self('x', $subtype, '.');
    }

    private function __construct(string $prefix, Subtype $subtype, string $delimiter)
    {
        $this->prefix = $prefix;
        $this->subtype = $subtype;
        $this->delimiter = $delimiter;
    }

    public function inferred(string $facetedName): RegistrationTree
    {
        $names = explode($this->delimiter, $facetedName);

        if ($names[0] === $this->prefix) {
            array_shift($names);
        }

        return new self($this->prefix, $this->subtype->inferred($names), $this->delimiter);
    }

    public function subtypeNames(): array
    {
        return $this->subtype->names();
    }

    public function glue(): string
    {
        return $this->subtype->glue();
    }

    public function __toString(): string
    {
        return implode($this->glue(), $this->subtypeNames());
    }
}
