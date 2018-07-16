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

namespace DreadLabs\MediaTypeDecoding\Tests\Integration;

use DreadLabs\MediaTypeDecoding\Domain\Application;
use DreadLabs\MediaTypeDecoding\Domain\Parameter;
use DreadLabs\MediaTypeDecoding\Domain\RegistrationTree;
use DreadLabs\MediaTypeDecoding\Domain\Subtype\Imploded;
use DreadLabs\MediaTypeDecoding\Domain\Subtype\Prefixed;
use DreadLabs\MediaTypeDecoding\Domain\Subtype\UpperCamelCasedFromHyphened;
use DreadLabs\MediaTypeDecoding\Domain\Suffix;
use PHPUnit\Framework\TestCase;

class MediaTypeTest extends TestCase
{
    /**
     * @test
     */
    public function readme_example_1()
    {
        $mediaType = new Application(RegistrationTree::vendor(new UpperCamelCasedFromHyphened(new Imploded('\\'))));

        $withParameter = $mediaType->withParameter(new Parameter('version'));
        $withSuffix = $withParameter->withSuffix(Suffix::none());

        self::assertSame(
            'Acme\\CustomerApi\\Domain\\Event\\ItemAddedToCart',
            (string)$withSuffix->inferred('application/vnd.acme.customer-api.domain.event.item-added-to-cart; version=1.0')
        );
    }

    /**
     * @test
     */
    public function readme_example_2()
    {
        $prefix = ['acme', 'customer-api', 'domain'];
        $subtype = new Prefixed(new UpperCamelCasedFromHyphened(new Imploded('\\')), $prefix);
        $mediaType = new Application(RegistrationTree::personal($subtype));

        self::assertSame(
            'Acme\\CustomerApi\\Domain\\Event\\ItemRemovedFromCart',
            (string)$mediaType->inferred('application/prs.event.item-removed-from-cart')
        );
    }
}
