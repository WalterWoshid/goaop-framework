<?php

declare(strict_types=1);
/*
 * Go! AOP framework
 *
 * @copyright Copyright 2012-2022, Lisachenko Alexander <lisachenko.it@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Go\Lang\Attribute;

use Attribute;

/**
 * After throwing advice attribute
 */
#[Attribute(Attribute::TARGET_METHOD)]
class AfterThrowing extends BaseInterceptor
{
}
