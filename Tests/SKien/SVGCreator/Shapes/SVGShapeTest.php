<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Shapes;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Marker\SVGMarker;
use SKien\SVGCreator\Shapes\SVGShape;

/**
 * Class SVGShapeTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Shapes\SVGShape
 */
final class SVGShapeTest extends TestCase
{
    private SVGShape $oSVGShape;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        // just create a 'dummy' shape element
        $this->oSVGShape = new SVGShape('shape');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGShape);
    }

    public function testSetPathLength(): void
    {
        $this->oSVGShape->setPathLength(200);
        $this->assertEquals('200', $this->oSVGShape->getAttribute('pathLength'));
    }

    public function testSetMarker1(): void
    {
        $this->oSVGShape->setMarker('marker1', SVGMarker::MARKER_START);
        $this->assertEquals('url(#marker1)', $this->oSVGShape->getAttribute('marker-start'));
    }

    public function testSetMarker2(): void
    {
        $this->oSVGShape->setMarker('marker2', SVGMarker::MARKER_MID);
        $this->assertEquals('url(#marker2)', $this->oSVGShape->getAttribute('marker-mid'));
    }

    public function testSetMarker3(): void
    {
        $this->oSVGShape->setMarker('marker3', SVGMarker::MARKER_END);
        $this->assertEquals('url(#marker3)', $this->oSVGShape->getAttribute('marker-end'));
    }

    public function testSetMarker4(): void
    {
        $oMarker = new SVGMarker(10, 10);
        $oMarker->setID('marker4');
        $this->oSVGShape->setMarker($oMarker, SVGMarker::MARKER_END);
        $this->assertEquals('url(#marker4)', $this->oSVGShape->getAttribute('marker-end'));
    }

    public function testSetMarkerStart1(): void
    {
        $this->oSVGShape->setMarkerStart('marker1');
        $this->assertEquals('url(#marker1)', $this->oSVGShape->getAttribute('marker-start'));
    }

    public function testSetMarkerMid1(): void
    {
        $this->oSVGShape->setMarkerMid('marker2');
        $this->assertEquals('url(#marker2)', $this->oSVGShape->getAttribute('marker-mid'));
    }

    public function testSetMarkerEnd1(): void
    {
        $this->oSVGShape->setMarkerEnd('marker3');
        $this->assertEquals('url(#marker3)', $this->oSVGShape->getAttribute('marker-end'));
    }

    public function testSetMarkerStart2(): void
    {
        $oMarker = new SVGMarker(10, 10);
        $oMarker->setID('marker4');
        $this->oSVGShape->setMarkerStart($oMarker);
        $this->assertEquals('url(#marker4)', $this->oSVGShape->getAttribute('marker-start'));
    }

    public function testSetMarkerMid2(): void
    {
        $oMarker = new SVGMarker(10, 10);
        $oMarker->setID('marker5');
        $this->oSVGShape->setMarkerMid($oMarker);
        $this->assertEquals('url(#marker5)', $this->oSVGShape->getAttribute('marker-mid'));
    }

    public function testSetMarkerEnd2(): void
    {
        $oMarker = new SVGMarker(10, 10);
        $oMarker->setID('marker6');
        $this->oSVGShape->setMarkerEnd($oMarker);
        $this->assertEquals('url(#marker6)', $this->oSVGShape->getAttribute('marker-end'));
    }
}
