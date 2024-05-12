<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGDiffuseLightingEffect;

/**
 * Class SVGDiffuseLightingEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGDiffuseLightingEffect
 */
final class SVGDiffuseLightingEffectTest extends TestCase
{
    private SVGDiffuseLightingEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new SVGDiffuseLightingEffect('in', 'yellow', 1, 2, 3);
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
        $this->assertEquals('feDiffuseLighting', $this->oSVGEffect->getName());

        $this->assertEquals('in', $this->oSVGEffect->getAttribute('in'));
        $this->assertEquals('yellow', $this->oSVGEffect->getAttribute('lighting-color'));
        $this->assertEquals('1', $this->oSVGEffect->getAttribute('surfaceScale'));
        $this->assertEquals('2', $this->oSVGEffect->getAttribute('diffuseConstant'));
        $this->assertEquals('3', $this->oSVGEffect->getAttribute('kernelUnitLength'));
    }
}
