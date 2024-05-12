<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Gradients;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Gradients\SVGRadialGradient;

/**
 * Class SVGRadialGradientTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Gradients\SVGRadialGradient
 */
final class SVGRadialGradientTest extends TestCase
{
    private SVGRadialGradient $oSVGRadialGradient;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGRadialGradient = new SVGRadialGradient('20%', '30%', '40%', '25%', '35%');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGRadialGradient);
    }

    public function test__construct(): void
    {
        $this->assertEquals('radialGradient', $this->oSVGRadialGradient->getName());
        $this->assertEquals('20%', $this->oSVGRadialGradient->getAttribute('cx'));
        $this->assertEquals('30%', $this->oSVGRadialGradient->getAttribute('cy'));
        $this->assertEquals('40%', $this->oSVGRadialGradient->getAttribute('fr'));
        $this->assertEquals('25%', $this->oSVGRadialGradient->getAttribute('fx'));
        $this->assertEquals('35%', $this->oSVGRadialGradient->getAttribute('fy'));
    }
}
