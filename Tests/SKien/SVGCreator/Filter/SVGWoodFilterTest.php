<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\SVGWoodFilter;
use Tests\SKien\TestCaseAccessHelperTrait;

/**
 * Class SVGWoodFilterTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\SVGWoodFilter
 */
final class SVGWoodFilterTest extends TestCase
{
    use TestCaseAccessHelperTrait;

    private SVGWoodFilter $oSVGFilter;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGFilter = new SVGWoodFilter(5, 'beech', 'vert');
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
        $this->assertEquals(3, count($aChilds));
        $this->assertEquals('feTurbulence', $aChilds[0]->getName());
        $this->assertEquals('feColorMatrix', $aChilds[1]->getName());
        $this->assertEquals('feComposite', $aChilds[2]->getName());
    }

    public function test__construct2(): void
    {
        $this->oSVGFilter = new SVGWoodFilter(5, 'mahogany', 'vert');

        $this->assertEquals('filter', $this->oSVGFilter->getName());
        $aChilds = $this->getObjectProperty($this->oSVGFilter, 'aChilds');
        $this->assertEquals(4, count($aChilds));
        $this->assertEquals('feTurbulence', $aChilds[0]->getName());
        $this->assertEquals('feColorMatrix', $aChilds[1]->getName());
        $this->assertEquals('feComponentTransfer', $aChilds[2]->getName());
        $this->assertEquals('feComposite', $aChilds[3]->getName());
    }

    public function test__construct3(): void
    {
        $this->oSVGFilter = new SVGWoodFilter(5, 'pine', 'vert');

        $this->assertEquals('filter', $this->oSVGFilter->getName());
        $aChilds = $this->getObjectProperty($this->oSVGFilter, 'aChilds');
        $this->assertEquals(3, count($aChilds));
        $this->assertEquals('feTurbulence', $aChilds[0]->getName());
        $this->assertEquals('feColorMatrix', $aChilds[1]->getName());
        $this->assertEquals('feComposite', $aChilds[2]->getName());
    }
}
