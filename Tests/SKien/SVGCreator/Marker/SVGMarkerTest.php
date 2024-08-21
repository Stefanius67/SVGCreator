<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Marker;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Marker\SVGMarker;

/**
 * Class SVGMarkerTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Marker\SVGMarker
 */
final class SVGMarkerTest extends TestCase
{
    private SVGMarker $oSVGMarker;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGMarker = new SVGMarker(10, 10);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGMarker);
    }

    public function testSetMarkerUnits() : void
    {
        $this->oSVGMarker->setMarkerUnits('strokeWidth');
        $this->assertEquals('strokeWidth', $this->oSVGMarker->getAttribute('markerUnits'));
    }

    public function testSetOrientation() : void
    {
        $this->oSVGMarker->setOrientation('auto-start-reverse');
        $this->assertEquals('auto-start-reverse', $this->oSVGMarker->getAttribute('orient'));
    }

    public function testSetRefPoint() : void
    {
        $this->oSVGMarker->setRefPoint(10, 20);
        $this->assertEquals('10', $this->oSVGMarker->getAttribute('refX'));
        $this->assertEquals('20', $this->oSVGMarker->getAttribute('refY'));
    }
}
