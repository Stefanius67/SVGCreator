<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\ExtShapes;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\ExtShapes\SVGBlockArrow;
use SKien\SVGCreator\ExtShapes\SVGBlockArrowDef;

/**
 * Class SVGBlockArrowTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\ExtShapes\SVGBlockArrow
 * @covers \SKien\SVGCreator\ExtShapes\SVGBlockArrowDef
 */
final class SVGBlockArrowTest extends TestCase
{
    private SVGBlockArrowDef $oDef;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        parent::setUp();

        $this->oDef = new SVGBlockArrowDef(20, 30, 20);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown() : void
    {
        parent::tearDown();

        unset($this->oDef);
    }

    public function constructSingleProvider() : array
    {
        return [
            [100, 100, 200, 200, 'translate(100, 100) rotate(45)'],
            [200, 100, 100, 200, 'translate(200, 100) rotate(135)'],
            [200, 200, 100, 100, 'translate(200, 200) rotate(225)'],
            [100, 200, 200, 100, 'translate(100, 200) rotate(-45)'],
        ];
    }

    /**
     * @dataProvider constructSingleProvider
     */
    public function testConstructSingle($x1, $y1, $x2, $y2, $exp) : void
    {
        $oSVGBlockArrow = new SVGBlockArrow($x1, $y1, $x2, $y2, $this->oDef, SVGBlockArrow::SINGLE);
        $this->assertEquals('M 0 0 L 0 10 L 121.42135623731 10 L 121.42135623731 15 L 141.42135623731 0 L 121.42135623731 -15 L 121.42135623731 -10 L 0 -10 Z', trim($oSVGBlockArrow->getAttribute('d')));
        $this->assertEquals($exp, $oSVGBlockArrow->getAttribute('transform'));
    }

    public function testConstructDouble() : void
    {
        $oSVGBlockArrow = new SVGBlockArrow(100, 100, 200, 200, $this->oDef, SVGBlockArrow::DOUBLE);
        $this->assertIsObject($oSVGBlockArrow);
    }

    public function testConstructAngledVert() : void
    {
        $oSVGBlockArrow = new SVGBlockArrow(100, 100, 200, 200, $this->oDef, SVGBlockArrow::ANGLED_VERT);
        $this->assertIsObject($oSVGBlockArrow);
    }

    public function testConstructAngledHorz() : void
    {
        $oSVGBlockArrow = new SVGBlockArrow(100, 100, 200, 200, $this->oDef, SVGBlockArrow::ANGLED_HORZ);
        $this->assertIsObject($oSVGBlockArrow);
    }

    public function testConstructAngledDouble() : void
    {
        $oSVGBlockArrow = new SVGBlockArrow(100, 100, 200, 200, $this->oDef, SVGBlockArrow::ANGLED_DOUBLE);
        $this->assertIsObject($oSVGBlockArrow);
    }

    public function constructRoundedVertProvider() : array
    {
        return [
            [100, 100, 300, 200, 'M 0 0 L 0 10 L 120 10 A 70 70, 0, 0, 1, 190 80 L 190 80 L 185 80 L 200 100 L 215 80 L 210 80 A 90 90, 0, 0, 0, 120 -10 L 0 -10 Z'],
            [300, 100, 100, 200, 'M 0 0 L 0 10 L -120 10 A 70 70, 0, 0, 0, -190 80 L -190 80 L -185 80 L -200 100 L -215 80 L -210 80 A 90 90, 0, 0, 1, -120 -10 L 0 -10 Z'],
            [300, 200, 100, 100, 'M 0 0 L 0 -10 L -120 -10 A 70 70, 0, 0, 1, -190 -80 L -190 -80 L -185 -80 L -200 -100 L -215 -80 L -210 -80 A 90 90, 0, 0, 0, -120 10 L 0 10 Z'],
            [100, 200, 300, 100, 'M 0 0 L 0 -10 L 120 -10 A 70 70, 0, 0, 0, 190 -80 L 190 -80 L 185 -80 L 200 -100 L 215 -80 L 210 -80 A 90 90, 0, 0, 1, 120 10 L 0 10 Z'],
            [100, 100, 200, 300, 'M 0 0 L 0 10 A 90 90, 0, 0, 1, 90 100 L 90 180 L 85 180 L 100 200 L 115 180 L 110 180 L 110 100 A 110 110, 0, 0, 0, 0 -10 Z'],
            [200, 100, 100, 300, 'M 0 0 L 0 10 A 90 90, 0, 0, 0, -90 100 L -90 180 L -85 180 L -100 200 L -115 180 L -110 180 L -110 100 A 110 110, 0, 0, 1, 0 -10 Z'],
            [200, 300, 100, 100, 'M 0 0 L 0 -10 A 90 90, 0, 0, 1, -90 -100 L -90 -180 L -85 -180 L -100 -200 L -115 -180 L -110 -180 L -110 -100 A 110 110, 0, 0, 0, 0 10 Z'],
            [100, 300, 200, 100, 'M 0 0 L 0 -10 A 90 90, 0, 0, 0, 90 -100 L 90 -180 L 85 -180 L 100 -200 L 115 -180 L 110 -180 L 110 -100 A 110 110, 0, 0, 1, 0 10 Z'],
        ];
    }

    /**
     * @dataProvider constructRoundedVertProvider
     */
    public function testConstructRoundedVert($x1, $y1, $x2, $y2, $exp) : void
    {
        $oSVGBlockArrow = new SVGBlockArrow($x1, $y1, $x2, $y2, $this->oDef, SVGBlockArrow::ROUNDED_VERT);
        $this->assertEquals($exp, trim($oSVGBlockArrow->getAttribute('d')));
    }

    public function constructRoundedHorzProvider() : array
    {
        return [
            [100, 100, 300, 200, 'M 0 0 L 10 0 A 90 90, 0, 0, 0, 100 90 L 180 90 L 180 85 L 200 100 L 180 115 L 180 110 L 100 110 A 110 110, 0, 0, 1, -10 0 Z'],
            [300, 100, 100, 200, 'M 0 0 L -10 0 A 90 90, 0, 0, 1, -100 90 L -180 90 L -180 85 L -200 100 L -180 115 L -180 110 L -100 110 A 110 110, 0, 0, 0, 10 0 Z'],
            [300, 200, 100, 100, 'M 0 0 L -10 0 A 90 90, 0, 0, 0, -100 -90 L -180 -90 L -180 -85 L -200 -100 L -180 -115 L -180 -110 L -100 -110 A 110 110, 0, 0, 1, 10 0 Z'],
            [100, 200, 300, 100, 'M 0 0 L 10 0 A 90 90, 0, 0, 1, 100 -90 L 180 -90 L 180 -85 L 200 -100 L 180 -115 L 180 -110 L 100 -110 A 110 110, 0, 0, 0, -10 0 Z'],
            [100, 100, 200, 300, 'M 0 0 L 10 0 L 10 120 A 70 70, 0, 0, 0, 80 190 L 80 190 L 80 185 L 100 200 L 80 215 L 80 210 A 90 90, 0, 0, 1, -10 120 L -10 0 Z'],
            [200, 100, 100, 300, 'M 0 0 L -10 0 L -10 120 A 70 70, 0, 0, 1, -80 190 L -80 190 L -80 185 L -100 200 L -80 215 L -80 210 A 90 90, 0, 0, 0, 10 120 L 10 0 Z'],
            [200, 300, 100, 100, 'M 0 0 L -10 0 L -10 -120 A 70 70, 0, 0, 0, -80 -190 L -80 -190 L -80 -185 L -100 -200 L -80 -215 L -80 -210 A 90 90, 0, 0, 1, 10 -120 L 10 0 Z'],
            [100, 300, 200, 100, 'M 0 0 L 10 0 L 10 -120 A 70 70, 0, 0, 1, 80 -190 L 80 -190 L 80 -185 L 100 -200 L 80 -215 L 80 -210 A 90 90, 0, 0, 0, -10 -120 L -10 0 Z'],
        ];
    }

    /**
     * @dataProvider constructRoundedHorzProvider
     */
    public function testConstructRoundedHorz($x1, $y1, $x2, $y2, $exp) : void
    {
        $oSVGBlockArrow = new SVGBlockArrow($x1, $y1, $x2, $y2, $this->oDef, SVGBlockArrow::ROUNDED_HORZ);
        $this->assertEquals($exp, trim($oSVGBlockArrow->getAttribute('d')));
    }

    public function constructRoundedDoubleProvider() : array
    {
        return [
            [100, 100, 300, 200, 'M 0 0 L 20 15 L 20 10 L 120 10 A 70 70, 0, 0, 1, 190 80 L 190 80 L 185 80 L 200 100 L 215 80 L 210 80 A 90 90, 0, 0, 0, 120 -10 L 20 -10 L 20 -10 L 20 -15 Z'],
            [300, 100, 100, 200, 'M 0 0 L -20 15 L -20 10 L -120 10 A 70 70, 0, 0, 0, -190 80 L -190 80 L -185 80 L -200 100 L -215 80 L -210 80 A 90 90, 0, 0, 1, -120 -10 L -20 -10 L -20 -10 L -20 -15 Z'],
            [300, 200, 100, 100, 'M 0 0 L -20 -15 L -20 -10 L -120 -10 A 70 70, 0, 0, 1, -190 -80 L -190 -80 L -185 -80 L -200 -100 L -215 -80 L -210 -80 A 90 90, 0, 0, 0, -120 10 L -20 10 L -20 10 L -20 15 Z'],
            [100, 200, 300, 100, 'M 0 0 L 20 -15 L 20 -10 L 120 -10 A 70 70, 0, 0, 0, 190 -80 L 190 -80 L 185 -80 L 200 -100 L 215 -80 L 210 -80 A 90 90, 0, 0, 1, 120 10 L 20 10 L 20 10 L 20 15 Z'],
            [100, 100, 200, 300, 'M 0 0 L 20 15 L 20 10 A 70 70, 0, 0, 1, 90 80 L 90 180 L 85 180 L 100 200 L 115 180 L 110 180 L 110 80 A 90 90, 0, 0, 0, 20 -10 L 20 -10 L 20 -15 Z'],
            [200, 100, 100, 300, 'M 0 0 L -20 15 L -20 10 A 70 70, 0, 0, 0, -90 80 L -90 180 L -85 180 L -100 200 L -115 180 L -110 180 L -110 80 A 90 90, 0, 0, 1, -20 -10 L -20 -10 L -20 -15 Z'],
            [200, 300, 100, 100, 'M 0 0 L -20 -15 L -20 -10 A 70 70, 0, 0, 1, -90 -80 L -90 -180 L -85 -180 L -100 -200 L -115 -180 L -110 -180 L -110 -80 A 90 90, 0, 0, 0, -20 10 L -20 10 L -20 15 Z'],
            [100, 300, 200, 100, 'M 0 0 L 20 -15 L 20 -10 A 70 70, 0, 0, 0, 90 -80 L 90 -180 L 85 -180 L 100 -200 L 115 -180 L 110 -180 L 110 -80 A 90 90, 0, 0, 1, 20 10 L 20 10 L 20 15 Z'],
        ];
    }

    /**
     * @dataProvider constructRoundedDoubleProvider
     */
    public function testConstructRoundedDouble($x1, $y1, $x2, $y2, $exp) : void
    {
        $oSVGBlockArrow = new SVGBlockArrow($x1, $y1, $x2, $y2, $this->oDef, SVGBlockArrow::ROUNDED_DOUBLE);
        $this->assertEquals($exp, trim($oSVGBlockArrow->getAttribute('d')));
    }
}
