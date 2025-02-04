<?php
/**
 * Go! AOP framework
 *
 * @copyright Copyright 2018-2022, Lisachenko Alexander <lisachenko.it@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Go\Stubs\Constructor;

class ClassWithPrivateConstructor
{
    private function __construct(string $className, int &$byReference)
    {
        echo $className;
        $byReference = 42;
    }

    public static function getInstance(): self
    {
        $value = 0;
        return new self(static::class, $value);
    }
}
