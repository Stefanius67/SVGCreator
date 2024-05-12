<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Gradients;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Gradients\SVGLinearGradient;

/**
 * Class SVGLinearGradientTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Gradients\SVGLinearGradient
 */
final class SVGLinearGradientTest extends TestCase
{
    private SVGLinearGradient $oSVGLinearGradient;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGLinearGradient = new SVGLinearGradient(10, 20, 50, 100);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGLinearGradient);
    }

    public function test__construct(): void
    {
        $this->assertEquals('linearGradient', $this->oSVGLinearGradient->getName());
        $this->assertEquals('10', $this->oSVGLinearGradient->getAttribute('x1'));
        $this->assertEquals('20', $this->oSVGLinearGradient->getAttribute('x2'));
        $this->assertEquals('50', $this->oSVGLinearGradient->getAttribute('y1'));
        $this->assertEquals('100', $this->oSVGLinearGradient->getAttribute('y2'));
    }
}
