<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGBlendEffect;
use SKien\SVGCreator\Filter\Effects\SVGEffect;

/**
 * Class SVGBlendEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGBlendEffect
 */
final class SVGBlendEffectTest extends TestCase
{
    private SVGBlendEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new SVGBlendEffect('in1', 'in2', SVGEffect::BLEND_COLOR);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGEffect);
    }

    public function test__construct(): void
    {
        $this->assertEquals('feBlend', $this->oSVGEffect->getName());

        $this->assertEquals('in1', $this->oSVGEffect->getAttribute('in'));
        $this->assertEquals('in2', $this->oSVGEffect->getAttribute('in2'));
        $this->assertEquals('color', $this->oSVGEffect->getAttribute('mode'));
    }
}
