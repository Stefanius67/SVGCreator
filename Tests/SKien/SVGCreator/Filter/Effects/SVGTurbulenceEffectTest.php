<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGTurbulenceEffect;

/**
 * Class SVGTurbulenceEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGTurbulenceEffect
 */
final class SVGTurbulenceEffectTest extends TestCase
{
    private SVGTurbulenceEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new SVGTurbulenceEffect(1, 2, 3, 'type', true);
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
        $this->assertEquals('feTurbulence', $this->oSVGEffect->getName());

        $this->assertEquals('1', $this->oSVGEffect->getAttribute('baseFrequency'));
        $this->assertEquals('2', $this->oSVGEffect->getAttribute('numOctaves'));
        $this->assertEquals('3', $this->oSVGEffect->getAttribute('seed'));
        $this->assertEquals('type', $this->oSVGEffect->getAttribute('type'));
        $this->assertEquals('stitch', $this->oSVGEffect->getAttribute('stitchTiles'));
    }
}
