<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\SVGRoughplasterFilter;
use Tests\SKien\TestCaseAccessHelperTrait;

/**
 * Class SVGRoughplasterFilterTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\SVGRoughplasterFilter
 */
final class SVGRoughplasterFilterTest extends TestCase
{
    use TestCaseAccessHelperTrait;

    private SVGRoughplasterFilter $oSVGFilter;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGFilter = new SVGRoughplasterFilter('red', 3);
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
        $this->assertEquals(3, count($aChilds));
        $this->assertEquals('feTurbulence', $aChilds[0]->getName());
        $this->assertEquals('feDiffuseLighting', $aChilds[1]->getName());
        $this->assertEquals('feComposite', $aChilds[2]->getName());
    }
}
