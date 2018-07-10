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

final class Parameter
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $inferredValue;

    /**
     * @var string
     */
    private $value;

    public function __construct(string $key)
    {
        $this->key = $key;
        $this->inferredValue = '';
        $this->value = '';
    }

    public function inferred(string $type): Parameter
    {
        $matches = [];
        $value = '';
        $inferredValue = '';
        if (1 === preg_match(sprintf('/; %s=(.[^;]+)/', preg_quote($this->key)), $type, $matches)) {
            $value = $matches[1];
            $inferredValue = $this->infer($type);
        }

        $parameter = clone $this;
        $parameter->value = $value;
        $parameter->inferredValue = $inferredValue;

        return $parameter;
    }

    public function equalTo(string $key): bool
    {
        return $this->key === $key;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->inferredValue;
    }

    private function infer(string $type): string
    {
        return preg_replace(sprintf('/; %s=.[^;]+/', preg_quote($this->key)), '', $type);
    }
}
