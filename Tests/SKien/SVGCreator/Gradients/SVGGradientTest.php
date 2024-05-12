<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Gradients;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Gradients\SVGGradient;
use SKien\SVGCreator\Gradients\SVGGradientStop;

/**
 * Class SVGGradientTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Gradients\SVGGradient
 */
final class SVGGradientTest extends TestCase
{
    private SVGGradient $oSVGGradient;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGGradient = new SVGGradient('gradient');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGGradient);
    }

    public function testAddStop1(): void
    {
        $oStop = $this->oSVGGradient->addStop(new SVGGradientStop(50, '#ff00ff', 0.5));
        $this->assertEquals('50', $oStop->getAttribute('offset'));
        $this->assertEquals('#ff00ff', $oStop->getAttribute('stop-color'));
        $this->assertEquals('0.5', $oStop->getAttribute('stop-opacity'));
    }

    public function testAddStop2(): void
    {
        $oStop = $this->oSVGGradient->addStop(50, '#ff00ff', 0.5);
        $this->assertEquals('50', $oStop->getAttribute('offset'));
        $this->assertEquals('#ff00ff', $oStop->getAttribute('stop-color'));
        $this->assertEquals('0.5', $oStop->getAttribute('stop-opacity'));
    }

    public function testSetGradientUnits() : void
    {
        $this->oSVGGradient->setGradientUnits('userSpaceOnUse');
        $this->assertEquals('userSpaceOnUse', $this->oSVGGradient->getAttribute('gradientUnits'));
    }

    public function testSetGradientTransform() : void
    {
        $this->oSVGGradient->setGradientTransform('test');
        $this->assertEquals('test', $this->oSVGGradient->getAttribute('gradientTransform'));
    }

    public function testSetSpreadMethod() : void
    {
        $this->oSVGGradient->setSpreadMethod('reflect');
        $this->assertEquals('reflect', $this->oSVGGradient->getAttribute('spreadMethod'));
    }
}
