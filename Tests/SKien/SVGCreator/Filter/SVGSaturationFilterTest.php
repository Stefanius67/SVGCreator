<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\SVGSaturationFilter;
use Tests\SKien\TestCaseAccessHelperTrait;

/**
 * Class SVGSaturationFilterTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\SVGSaturationFilter
 */
final class SVGSaturationFilterTest extends TestCase
{
    use TestCaseAccessHelperTrait;

    private SVGSaturationFilter $oSVGFilter;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGFilter = new SVGSaturationFilter(2);
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
        $this->assertEquals('feColorMatrix', $aChilds[0]->getName());
    }
}
