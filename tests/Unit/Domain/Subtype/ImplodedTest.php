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
use PHPUnit\Framework\TestCase;

class ImplodedTest extends TestCase
{
    /**
     * @test
     */
    public function it_implodes_a_list_of_names_into_a_faceted_form_using_a_glue_string()
    {
        $subtype = new Imploded('\\');

        $subtype = $subtype->inferred(['lorem', 'ipsum', 'dolor', 'sit', 'amet']);

        self::assertInstanceOf(Imploded::class, $subtype);
        self::assertSame(['lorem', 'ipsum', 'dolor', 'sit', 'amet'], $subtype->names());
        self::assertSame('lorem\\ipsum\\dolor\\sit\\amet', (string)$subtype);
    }
}
