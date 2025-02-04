<?php
/**
 * Go! AOP framework
 *
 * @copyright Copyright 2012-2022, Lisachenko Alexander <lisachenko.it@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Go\Aop;

/**
 * Interface supplying the information necessary to describe an introduction of trait.
 *
 * If an Advice implements this, it may be used as an introduction without an IntroductionAdvisor.
 * In this case, the advice is self-describing, providing not only the necessary behavior,
 * but describing the interfaces it introduces.
 */
interface IntroductionInfo extends Advice
{
    /**
     * Returns the additional interface introduced by this Advisor or Advice.
     *
     * @return string[]
     */
    public function getInterfaces(): array;

    /**
     * Return the additional trait with realization of introduced interface
     *
     * @return string[]
     */
    public function getTraits(): array;
}
