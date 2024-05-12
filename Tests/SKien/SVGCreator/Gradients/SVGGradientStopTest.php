<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Gradients;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Gradients\SVGGradientStop;

/**
 * Class SVGGradientStopTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Gradients\SVGGradientStop
 */
final class SVGGradientStopTest extends TestCase
{
    private SVGGradientStop $oSVGGradientStop;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGGradientStop = new SVGGradientStop(10, 'green', 0.8);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGGradientStop);
    }

    public function test__construct(): void
    {
        $this->assertEquals('stop', $this->oSVGGradientStop->getName());
        $this->assertEquals('10', $this->oSVGGradientStop->getAttribute('offset'));
        $this->assertEquals('green', $this->oSVGGradientStop->getAttribute('stop-color'));
        $this->assertEquals('0.8', $this->oSVGGradientStop->getAttribute('stop-opacity'));
    }
}
