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
 * Declare error attribute
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class DeclareError extends BaseAttribute
{
    /**
     * Interface name to add
     */
    public int $level;

    /**
     * DeclareError Constructor
     *
     * @param string $value
     * @param int $level
     */
    final public function __construct(string $value, int $level = E_USER_NOTICE)
    {
        parent::__construct($value);
        $this->level = $level;
    }
}
