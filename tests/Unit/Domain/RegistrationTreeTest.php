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

use DreadLabs\MediaTypeDecoding\Domain\RegistrationTree;
use DreadLabs\MediaTypeDecoding\Domain\Subtype\Imploded;
use PHPUnit\Framework\TestCase;

class RegistrationTreeTest extends TestCase
{
    /**
     * @test
     */
    public function it_infers_a_name_with_standard_registration_tree_prefix()
    {
        $tree = RegistrationTree::standard(new Imploded('.'));

        $tree = $tree->inferred('foo-bar');

        self::assertSame(['foo', 'bar'], $tree->subtypeNames());
        self::assertSame('foo.bar', (string)$tree);
    }

    /**
     * @test
     */
    public function it_infers_a_faceted_name_with_vendor_registration_tree_prefix()
    {
        $tree = RegistrationTree::vendor(new Imploded('.'));

        $tree = $tree->inferred('vnd.foo.bar');

        self::assertSame(['foo', 'bar'], $tree->subtypeNames());
        self::assertSame('foo.bar', (string)$tree);
    }

    /**
     * @test
     */
    public function it_infers_a_faceted_name_with_personal_registration_tree_prefix()
    {
        $tree = RegistrationTree::personal(new Imploded('.'));

        $tree = $tree->inferred('prs.foo.bar');

        self::assertSame(['foo', 'bar'], $tree->subtypeNames());
        self::assertSame('foo.bar', (string)$tree);
    }

    /**
     * @test
     */
    public function it_infers_a_faceted_name_with_unregistered_registration_tree_prefix()
    {
        $tree = RegistrationTree::unregistered(new Imploded('.'));

        $tree = $tree->inferred('x.foo.bar');

        self::assertSame(['foo', 'bar'], $tree->subtypeNames());
        self::assertSame('foo.bar', (string)$tree);
    }
}
