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

final class Parameters
{
    /**
     * @var Parameter[]
     */
    private $parameters;

    /**
     * @var string
     */
    private $inferredValue;

    public function __construct()
    {
        $this->parameters = [];
        $this->inferredValue = '';
    }

    public function withParameter(Parameter $parameter)
    {
        $parameters = clone $this;
        $parameters->parameters[] = $parameter;

        return $parameters;
    }

    public function inferred(string $type): Parameters
    {
        $parameters = [];

        foreach ($this->parameters as $parameter) {
            $inferredParameter = $parameter->inferred($type);
            $parameters[] = $inferredParameter;
            $type = (string)$inferredParameter;
        }

        $instance = clone $this;
        $instance->parameters = $parameters;
        $instance->inferredValue = $type;

        return $instance;
    }

    public function value(string $key): string
    {
        foreach ($this->parameters as $parameter) {
            if ($parameter->equalTo($key)) {
                return $parameter->value();
            }
        }
    }

    public function __toString(): string
    {
        return $this->inferredValue;
    }
}
