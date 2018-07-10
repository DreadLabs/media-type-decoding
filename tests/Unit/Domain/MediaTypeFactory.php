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

namespace DreadLabs\MediaTypeDecoding\Tests\Unit\Domain;

use DreadLabs\MediaTypeEncoding\Domain as Encoding;

final class MediaTypeFactory
{
    public static function withSuffix($object): Encoding\MediaType
    {
        $inferenceId = spl_object_hash($object);

        $mediaType = new Encoding\Application(
            Encoding\RegistrationTree::personal(
                new Encoding\Subtype\HyphenedFromUpperCamelCased(new Encoding\Subtype\Exploded('\\'))
            )->designated(get_class($object))
        );

        return $mediaType->withSuffix(new Encoding\Suffix\Json())
                         ->withParameter(new Encoding\Parameter('id', $inferenceId));
    }

    public static function withoutSuffix($object): Encoding\MediaType
    {
        return self::withSuffix($object)->withSuffix(Encoding\Suffix::none());
    }
}
