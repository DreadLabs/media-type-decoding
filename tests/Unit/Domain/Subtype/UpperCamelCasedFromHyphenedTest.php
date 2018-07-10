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

namespace DreadLabs\MediaTypeDecoding\Tests\Unit\Domain\Subtype;

use DreadLabs\MediaTypeDecoding\Domain\Subtype\Imploded;
use DreadLabs\MediaTypeDecoding\Domain\Subtype\UpperCamelCasedFromHyphened;
use PHPUnit\Framework\TestCase;

/** @group mediatype */
class UpperCamelCasedFromHyphenedTest extends TestCase
{
    /**
     * @test
     */
    public function it_transforms_a_lowercased_dash_delimited_list_of_names_to_an_uppercamelcased_list_of_names_decorating_another_subtype()
    {
        $subtype = new UpperCamelCasedFromHyphened(new Imploded('.'));

        $value = (string)$subtype->inferred(['this-is', 'a-test', 'foo-bar']);

        self::assertSame('ThisIs.ATest.FooBar', $value);
    }
}
