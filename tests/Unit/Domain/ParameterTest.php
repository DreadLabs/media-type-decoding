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

use DreadLabs\MediaTypeDecoding\Domain\Parameter;
use PHPUnit\Framework\TestCase;

/** @group mediatype */
class ParameterTest extends TestCase
{
    /**
     * @test
     */
    public function it_infers_a_media_type_parameter()
    {
        $parameter = new Parameter('id');

        $value = $parameter->inferred('foo/bar; id=124');

        self::assertSame('foo/bar', (string)$value);
    }

    /**
     * @test
     */
    public function it_infers_a_media_type_parameter_out_of_multiple_from_the_beginning()
    {
        $parameter = new Parameter('id');

        $value = $parameter->inferred('foo/bar; id=1234; version=1.0');

        self::assertSame('foo/bar; version=1.0', (string)$value);
    }

    /**
     * @test
     */
    public function it_infers_a_media_type_parameter_out_of_multiple_from_the_middle()
    {
        $parameter = new Parameter('id');

        $value = $parameter->inferred('foo/bar; version=1.0; id=99; charset=utf-8');

        self::assertSame('foo/bar; version=1.0; charset=utf-8', (string)$value);
    }

    /**
     * @test
     */
    public function it_infers_a_media_type_parameter_out_of_multiple_from_the_end()
    {
        $parameter = new Parameter('id');

        $value = $parameter->inferred('foo/bar; version=1.0; charset=utf-8; id=123');

        self::assertSame('foo/bar; version=1.0; charset=utf-8', (string)$value);
    }

    /**
     * @test
     */
    public function it_reveals_the_inferred_value()
    {
        $parameter = new Parameter('version');

        $parameter = $parameter->inferred('foo/bar; version=1.0');

        self::assertSame('foo/bar', (string)$parameter);
        self::assertSame('1.0', $parameter->value());
    }
}
