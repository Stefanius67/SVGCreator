<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\SVGBlurShadowFilter;
use SKien\SVGCreator\Filter\Effects\SVGEffect;
use Tests\SKien\TestCaseAccessHelperTrait;

/**
 * Class SVGBlurShadowFilterTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\SVGBlurShadowFilter
 */
final class SVGBlurShadowFilterTest extends TestCase
{
    use TestCaseAccessHelperTrait;

    private SVGBlurShadowFilter $oSVGFilter;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGFilter = new SVGBlurShadowFilter(10, 20, 2, 'green', 0.6);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGFilter);
    }

    public function test__construct1(): void
    {
        $this->assertEquals('filter', $this->oSVGFilter->getName());

        $aChilds = $this->getObjectProperty($this->oSVGFilter, 'aChilds');
        $this->assertCount(5, $aChilds);
        $i = 0;
        $this->assertEquals('feOffset', $aChilds[$i++]->getName());
        $this->assertEquals('feGaussianBlur', $aChilds[$i++]->getName());
        $this->assertEquals('feFlood', $aChilds[$i++]->getName());
        $this->assertEquals('feComposite', $aChilds[$i++]->getName());
        $this->assertEquals('feMerge', $aChilds[$i++]->getName());
    }

    public function test__construct2(): void
    {
        $this->oSVGFilter = new SVGBlurShadowFilter(10, 20, 2, SVGEffect::IN_SOURCE_ALPHA);

        $this->assertEquals('filter', $this->oSVGFilter->getName());

        $aChilds = $this->getObjectProperty($this->oSVGFilter, 'aChilds');
        $this->assertCount(3, $aChilds);
        $i = 0;
        $this->assertEquals('feOffset', $aChilds[$i++]->getName());
        $this->assertEquals('feGaussianBlur', $aChilds[$i++]->getName());
        $this->assertEquals('feMerge', $aChilds[$i++]->getName());
    }
}
