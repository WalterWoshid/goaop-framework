<?php
/**
 * Go! AOP framework
 *
 * @copyright Copyright 2011-2022, Lisachenko Alexander <lisachenko.it@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Go\Aop\Framework;

use Go\Aop\AdviceAfter;
use Go\Aop\AdviceAround;
use Go\Aop\AdviceBefore;
use PHPUnit\Framework\TestCase;

class AbstractJoinpointTest extends TestCase
{
    protected AbstractJoinpoint $joinpoint;

    /**
     * @dataProvider sortingTestSource
     * @param array $advices
     * @param array $order
     */
    public function testSortingLogic(array $advices, array $order = []): void
    {
        $advices = AbstractJoinpoint::sortAdvices($advices);
        foreach ($advices as $advice) {
            $expected = array_shift($order);
            $this->assertInstanceOf($expected, $advice);
        }
    }

    public function sortingTestSource(): array
    {
        return [
            // #0
            [
                [
                    $this->createMock(AdviceAfter::class),
                    $this->createMock(AdviceBefore::class)
                ],
                [
                    AdviceBefore::class,
                    AdviceAfter::class
                ]
            ],
            // #1
            [
                [
                    $this->createMock(AdviceAfter::class),
                    $this->createMock(AdviceAround::class)
                ],
                [
                    AdviceAfter::class,
                    AdviceAround::class
                ]
            ],
            // #2
            [
                [
                    $this->createMock(AdviceBefore::class),
                    $this->createMock(AdviceAfter::class)
                ],
                [
                    AdviceBefore::class,
                    AdviceAfter::class
                ]
            ],
            // #3
            [
                [
                    $this->createMock(AdviceBefore::class),
                    $this->createMock(AdviceAround::class)
                ],
                [
                    AdviceBefore::class,
                    AdviceAround::class
                ]
            ],
            // #4
            [
                [
                    $this->createMock(AdviceAround::class),
                    $this->createMock(AdviceAfter::class)
                ],
                [
                    AdviceAfter::class,
                    AdviceAround::class
                ]
            ],
            // #5
            [
                [
                    $this->createMock(AdviceAround::class),
                    $this->createMock(AdviceBefore::class)
                ],
                [
                    AdviceBefore::class,
                    AdviceAround::class
                ]
            ],
            // #6
            [
                [
                    $this->createMock(AdviceBefore::class),
                    $this->createMock(AdviceAround::class),
                    $this->createMock(AdviceBefore::class),
                    $this->createMock(AdviceAfter::class),
                ],
                [
                    AdviceBefore::class,
                    AdviceBefore::class,
                    AdviceAfter::class,
                    AdviceAround::class,
                ]
            ],
            // #7
            [
                [
                    $forth = $this->getOrderedAdvice(4),
                    $first = $this->getOrderedAdvice(1)
                ],
                [
                    get_class($first),
                    get_class($forth),
                ]
            ],
        ];
    }

    /**
     * Returns the ordered advice
     */
    private function getOrderedAdvice(int $order): OrderedAdvice
    {
        $mock = $this->createMock(OrderedAdvice::class);
        $mock
            ->method('getAdviceOrder')
            ->willReturn($order);

        return $mock;
    }
}
