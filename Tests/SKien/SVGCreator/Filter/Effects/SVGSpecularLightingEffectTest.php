<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGSpecularLightingEffect;

/**
 * Class SVGSpecularLightingEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGSpecularLightingEffect
 */
final class SVGSpecularLightingEffectTest extends TestCase
{
    private SVGSpecularLightingEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new SVGSpecularLightingEffect('in', 'red', 1, 2, 3);
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
        $this->assertEquals('feSpecularLighting', $this->oSVGEffect->getName());

        $this->assertEquals('in', $this->oSVGEffect->getAttribute('in'));
        $this->assertEquals('red', $this->oSVGEffect->getAttribute('lighting-color'));
        $this->assertEquals('1', $this->oSVGEffect->getAttribute('surfaceScale'));
        $this->assertEquals('2', $this->oSVGEffect->getAttribute('specularConstant'));
        $this->assertEquals('3', $this->oSVGEffect->getAttribute('specularExponent'));
    }
}
