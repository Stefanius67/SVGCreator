<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\SVGCamouflageFilter;
use Tests\SKien\TestCaseAccessHelperTrait;

/**
 * Class SVGCamouflageFilterTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\SVGCamouflageFilter
 */
final class SVGCamouflageFilterTest extends TestCase
{
    use TestCaseAccessHelperTrait;

    private SVGCamouflageFilter $oSVGFilter;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGFilter = new SVGCamouflageFilter();
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
        $this->assertCount(5, $aChilds);
        $i = 0;
        $this->assertEquals('feTurbulence', $aChilds[$i++]->getName());
        $this->assertEquals('feComponentTransfer', $aChilds[$i++]->getName());
        $this->assertEquals('feColorMatrix', $aChilds[$i++]->getName());
        $this->assertEquals('feColorMatrix', $aChilds[$i++]->getName());
        $this->assertEquals('feComposite', $aChilds[$i++]->getName());
    }
}
