<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Shapes;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Shapes\SVGRect;

/**
 * Class SVGRectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Shapes\SVGRect
 */
final class SVGRectTest extends TestCase
{
    private SVGRect $oSVGRect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGRect = new SVGRect(10, 20, 100, 200);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGRect);
    }

    public function test__construct(): void
    {
        $this->assertEquals('rect', $this->oSVGRect->getName());
        $this->assertEquals('10', $this->oSVGRect->getAttribute('x'));
        $this->assertEquals('20', $this->oSVGRect->getAttribute('y'));
        $this->assertEquals('100', $this->oSVGRect->getAttribute('width'));
        $this->assertEquals('200', $this->oSVGRect->getAttribute('height'));
    }

    public function testSetCornerRadius(): void
    {
        $this->oSVGRect->setCornerRadius(20);
        $this->assertEquals('20', $this->oSVGRect->getAttribute('rx'));
        $this->assertEquals('20', $this->oSVGRect->getAttribute('ry'));
        $this->oSVGRect->setCornerRadius(15, 25);
        $this->assertEquals('15', $this->oSVGRect->getAttribute('rx'));
        $this->assertEquals('25', $this->oSVGRect->getAttribute('ry'));
    }
}
