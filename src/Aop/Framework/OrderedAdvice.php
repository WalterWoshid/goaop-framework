<?php
/**
 * Go! AOP framework
 *
 * @copyright Copyright 2013-2022, Lisachenko Alexander <lisachenko.it@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Go\Aop\Framework;

use Go\Aop\Advice;

/**
 * Ordered advice can have a custom order to implement sorting
 */
interface OrderedAdvice extends Advice
{
    /**
     * Returns the advice order
     */
    public function getAdviceOrder(): int;
}
