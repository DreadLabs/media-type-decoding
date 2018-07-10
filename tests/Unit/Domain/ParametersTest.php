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
use DreadLabs\MediaTypeDecoding\Domain\Parameters;
use PHPUnit\Framework\TestCase;

class ParametersTest extends TestCase
{
    /**
     * @var Parameters
     */
    private $parameters;

    /**
     * @test
     */
    public function it_foooooo_baaaars()
    {
        $parameters = $this->parameters->withParameter(new Parameter('fizz'));

        $parameters = $parameters->inferred('foo/bar; fizz=buzz');

        self::assertSame('foo/bar', (string)$parameters);
    }

    protected function setUp()
    {
        $this->parameters = new Parameters();
    }
}
