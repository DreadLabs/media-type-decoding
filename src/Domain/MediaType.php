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

abstract class MediaType
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var RegistrationTree
     */
    private $tree;

    /**
     * @var Suffix
     */
    private $suffix;

    /**
     * @var Parameters
     */
    private $parameters;

    protected function __construct(string $type, RegistrationTree $tree)
    {
        $this->type = $type;
        $this->tree = $tree;
        $this->suffix = Suffix::none();
        $this->parameters = new Parameters();
    }

    final public function withSuffix(Suffix $suffix): MediaType
    {
        $mediaType = clone $this;
        $mediaType->suffix = $suffix;

        return $mediaType;
    }

    final public function withParameter(Parameter $parameter): MediaType
    {
        $mediaType = clone $this;
        $mediaType->parameters = $mediaType->parameters->withParameter($parameter);

        return $mediaType;
    }

    final public function inferred(string $type): MediaType
    {
        $type = str_replace(sprintf('%s/', $this->type), '', $type);
        $type = $this->suffix->infer($type);

        $parameters = $this->parameters->inferred($type);
        $type = (string)$parameters;

        $mediaType = clone $this;
        $mediaType->parameters = $parameters;
        $mediaType->tree = $this->tree->inferred($type);

        return $mediaType;
    }

    public function parameter(string $key): string
    {
        return $this->parameters->value($key);
    }

    public function __toString()
    {
        return (string)$this->tree;
    }
}
