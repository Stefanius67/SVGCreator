<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Shapes;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Shapes\SVGPath;

/**
 * Class SVGPathTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Shapes\SVGPath
 */
final class SVGPathTest extends TestCase
{
    private SVGPath $oSVGPath;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGPath = new SVGPath();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGPath);
    }

    public function test__construct(): void
    {
        $this->assertEquals('path', $this->oSVGPath->getName());
    }

    public function testFromString(): void
    {
        $this->oSVGPath = SVGPath::fromString('M 10 20 L 30 40');
        $this->expectPathEnd('L 30 40');
    }

    public function testMoveTo(): void
    {
        $this->oSVGPath->moveTo(10, 20);
        $this->expectPathEnd('M 10 20');
    }

    public function testMove(): void
    {
        $this->oSVGPath->move(10, 20);
        $this->expectPathEnd('m 10 20');
    }

    public function testLineTo(): void
    {
        $this->oSVGPath->moveTo(10, 20);
        $this->oSVGPath->lineTo(30, 40);
        $this->expectPathEnd('L 30 40');
    }

    public function testLine(): void
    {
        $this->oSVGPath->moveTo(10, 20);
        $this->oSVGPath->line(30, 40);
        $this->expectPathEnd('l 30 40');
    }

    public function testHorzLineTo(): void
    {
        $this->oSVGPath->moveTo(10, 20);
        $this->oSVGPath->horzLineTo(50);
        $this->expectPathEnd('H 50');
    }

    public function testHorzLine(): void
    {
        $this->oSVGPath->moveTo(10, 20);
        $this->oSVGPath->horzLine(50);
        $this->expectPathEnd('h 50');
    }

    public function testVertLineTo(): void
    {
        $this->oSVGPath->moveTo(10, 20);
        $this->oSVGPath->vertLineTo(50);
        $this->expectPathEnd('V 50');
    }

    public function testVertLine(): void
    {
        $this->oSVGPath->moveTo(10, 20);
        $this->oSVGPath->vertLine(50);
        $this->expectPathEnd('v 50');
    }

    public function testClose(): void
    {
        $this->oSVGPath->moveTo(10, 20);
        $this->oSVGPath->close();
        $this->expectPathEnd('Z');
    }

    public function testArcAt(): void
    {
        $this->oSVGPath->arcAt(100, 200, 15, 1, 0, 40, 60);
        $this->expectPathEnd('A 100 200, 15, 1, 0, 40 60');
    }

    public function testArc(): void
    {
        $this->oSVGPath->arc(100, 200, 15, 1, 0, 40, 60);
        $this->expectPathEnd('a 100 200, 15, 1, 0, 40 60');
    }

    public function testCurveTo(): void
    {
        $this->oSVGPath->curveTo(100, 200, 400, 300, 50, 60);
        $this->expectPathEnd('C 100 200, 400 300, 50 60');
    }

    public function testCurve(): void
    {
        $this->oSVGPath->curve(100, 200, 400, 300, 50, 60);
        $this->expectPathEnd('c 100 200, 400 300, 50 60');
    }

    public function testSmoothCurveTo(): void
    {
        $this->oSVGPath->curveTo(100, 200, 400, 300, 50, 60);
        $this->oSVGPath->smoothCurveTo(600, 800, 50, 60);
        $this->expectPathEnd('S 600 800, 50 60');
    }

    public function testSmoothCurve(): void
    {
        $this->oSVGPath->curve(100, 200, 400, 300, 50, 60);
        $this->oSVGPath->smoothCurve(600, 800, 50, 60);
        $this->expectPathEnd('s 600 800, 50 60');
    }

    public function testSmoothCurveToWarning(): void
    {
        $this->expectWarning();
        $this->oSVGPath->smoothCurveTo(600, 800, 50, 60);
    }

    public function testSmoothCurveWarning(): void
    {
        $this->expectWarning();
        $this->oSVGPath->smoothCurve(600, 800, 50, 60);
    }

    public function testQuadraticCurveTo(): void
    {
        $this->oSVGPath->quadraticCurveTo(100, 200, 50, 60);
        $this->expectPathEnd('Q 100 200, 50 60');
    }

    public function testQuadraticCurve(): void
    {
        $this->oSVGPath->quadraticCurve(100, 200, 50, 60);
        $this->expectPathEnd('q 100 200, 50 60');
    }

    public function testSmoothQuadraticCurveTo(): void
    {
        $this->oSVGPath->quadraticCurveTo(100, 200, 50, 60);
        $this->oSVGPath->smoothQuadraticCurveTo(70, 80);
        $this->expectPathEnd('T 70 80');
    }

    public function testSmoothQuadraticCurve(): void
    {
        $this->oSVGPath->quadraticCurve(100, 200, 50, 60);
        $this->oSVGPath->smoothQuadraticCurve(70, 80);
        $this->expectPathEnd('t 70 80');
    }

    public function testSmoothQuadraticCurveToWarning(): void
    {
        $this->expectWarning();
        $this->oSVGPath->smoothQuadraticCurveTo(70, 80);
    }

    public function testSmoothQuadraticCurveWarning(): void
    {
        $this->expectWarning();
        $this->oSVGPath->smoothQuadraticCurve(70, 80);
    }

    private function expectPathEnd(string $strEnd) : void
    {
        $strPath = trim($this->oSVGPath->getAttribute('d'));
        $this->assertEquals($strEnd, substr($strPath, -1 * strlen($strEnd)));
    }
}
