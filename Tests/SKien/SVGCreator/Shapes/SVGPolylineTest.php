<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Shapes;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Shapes\SVGPolyline;

/**
 * Class SVGPolylineTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Shapes\SVGPolyline
 */
final class SVGPolylineTest extends TestCase
{
    private SVGPolyline $oSVGPolyline;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->oSVGPolyline = new SVGPolyline([1, 2, 3, 4, 5]);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGPolyline);
    }

    public function test__construct(): void
    {
        $this->assertEquals('polyline', $this->oSVGPolyline->getName());
        $this->assertEquals('1 2 3 4 5', $this->oSVGPolyline->getAttribute('points'));
    }
}
