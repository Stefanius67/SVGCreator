<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Marker;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Marker\SVGBasicMarker;

/**
 * Class SVGBasicMarkerTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Marker\SVGBasicMarker
 */
final class SVGBasicMarkerTest extends TestCase
{
    private SVGBasicMarker $oSVGMarker;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGMarker = new SVGBasicMarker();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGMarker);
    }

    public function test_construct1(): void
    {
        $this->assertEquals('marker', $this->oSVGMarker->getName());
    }

    public function test_construct2(): void
    {
        $this->oSVGMarker = new SVGBasicMarker(SVGBasicMarker::RHOMBUS);
        $this->assertEquals('marker', $this->oSVGMarker->getName());
    }

    public function test_construct3(): void
    {
        $this->oSVGMarker = new SVGBasicMarker(SVGBasicMarker::SQUARE, [10, 15]);
        $this->assertEquals('10', $this->oSVGMarker->getAttribute('markerWidth'));
        $this->assertEquals('15', $this->oSVGMarker->getAttribute('markerHeight'));
    }

    public function test_construct4(): void
    {
        $this->expectWarning();
        $this->oSVGMarker = new SVGBasicMarker(10);
    }
}
