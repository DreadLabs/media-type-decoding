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

use DreadLabs\MediaTypeDecoding\Domain\Application;
use DreadLabs\MediaTypeDecoding\Domain\Parameter;
use DreadLabs\MediaTypeDecoding\Domain\RegistrationTree;
use DreadLabs\MediaTypeDecoding\Domain\Subtype\Imploded;
use DreadLabs\MediaTypeDecoding\Domain\Subtype\UpperCamelCasedFromHyphened;
use DreadLabs\MediaTypeDecoding\Domain\Suffix;
use DreadLabs\MediaTypeDecoding\Domain\Suffix\Json;
use PHPUnit\Framework\TestCase;

/** @group mediatype */
class MediaTypeTest extends TestCase
{
    /**
     * @test
     */
    public function it_infers_a_media_type_with_suffix()
    {
        $dummyObject = new DummyObject();
        $encodingMediaType = MediaTypeFactory::withSuffix($dummyObject);

        $decodingMediaType = (new Application(
            RegistrationTree::personal(
                new UpperCamelCasedFromHyphened(
                    new Imploded('\\')
                )
            )
        ))->withSuffix(new Json())->withParameter(new Parameter('id'));

        self::assertSame(
            DummyObject::class,
            (string)$decodingMediaType->inferred((string)$encodingMediaType)
        );
    }

    /**
     * @test
     */
    public function it_infers_a_media_type_without_suffix()
    {
        $dummyObject = new DummyObject();
        $encodingMediaType = MediaTypeFactory::withoutSuffix($dummyObject);

        $decodingMediaType = (new Application(
            RegistrationTree::personal(
                new UpperCamelCasedFromHyphened(
                    new Imploded('\\')
                )
            )
        ))->withSuffix(Suffix::none())->withParameter(new Parameter('id'));

        self::assertSame(
            DummyObject::class,
            (string)$decodingMediaType->inferred((string)$encodingMediaType)
        );
    }

    /**
     * @test
     */
    public function inferring_reveals_parameters()
    {
        $dummyObject = new DummyObject();
        $encodingMediaType = MediaTypeFactory::withSuffix($dummyObject);

        $decodingMediaType = (new Application(
            RegistrationTree::personal(
                new UpperCamelCasedFromHyphened(
                    new Imploded('\\')
                )
            )
        ))->withSuffix(new Json())
          ->withParameter(new Parameter('id'))
          ->inferred((string)$encodingMediaType);

        self::assertSame(spl_object_hash($dummyObject), $decodingMediaType->parameter('id'));
    }
}
