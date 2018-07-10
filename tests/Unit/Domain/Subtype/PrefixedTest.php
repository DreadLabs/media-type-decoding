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
use DreadLabs\MediaTypeDecoding\Domain\Subtype\Prefixed;
use PHPUnit\Framework\TestCase;

class PrefixedTest extends TestCase
{
    /**
     * @test
     */
    public function it_prefixes_a_list_of_names_decorating_another_subtype()
    {
        $subtype = new Prefixed(new Imploded('.'), ['foo', 'bar']);

        $subtype = $subtype->inferred(['lorem', 'ipsum']);

        self::assertInstanceOf(Prefixed::class, $subtype);
        self::assertSame(['foo', 'bar', 'lorem', 'ipsum'], $subtype->names());
        self::assertSame('foo.bar.lorem.ipsum', (string)$subtype);
    }
}
