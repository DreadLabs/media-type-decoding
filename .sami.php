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

return new Sami\Sami('./src', [
    'theme' => 'default',
    'title' => 'dreadlabs/media-type-decoding',
    'build_dir' => __DIR__.'/build/doc/api',
    'cache_dir' => __DIR__.'/build/doc/api/cache',
]);
