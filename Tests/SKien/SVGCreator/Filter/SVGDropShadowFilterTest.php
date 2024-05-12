<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\SVGDropShadowFilter;
use Tests\SKien\TestCaseAccessHelperTrait;

/**
 * Class SVGDropShadowFilterTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\SVGDropShadowFilter
 */
final class SVGDropShadowFilterTest extends TestCase
{
    use TestCaseAccessHelperTrait;

    private SVGDropShadowFilter $oSVGFilter;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGFilter = new SVGDropShadowFilter(10, 20, 1, 'red', 0.7);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGFilter);
    }

    public function test__construct(): void
    {
        $this->assertEquals('filter', $this->oSVGFilter->getName());

        $aChilds = $this->getObjectProperty($this->oSVGFilter, 'aChilds');
        $this->assertEquals(1, count($aChilds));
        $this->assertEquals('feDropShadow', $aChilds[0]->getName());
    }
}
