<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGDropShadowEffect;

/**
 * Class SVGDropShadowEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGDropShadowEffect
 */
final class SVGDropShadowEffectTest extends TestCase
{
    private SVGDropShadowEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new SVGDropShadowEffect(10, 15, 1, 'red', 0.6);
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
        $this->assertEquals('feDropShadow', $this->oSVGEffect->getName());

        $this->assertEquals('10', $this->oSVGEffect->getAttribute('dx'));
        $this->assertEquals('15', $this->oSVGEffect->getAttribute('dy'));
        $this->assertEquals('1', $this->oSVGEffect->getAttribute('stdDeviation'));
        $this->assertEquals('red', $this->oSVGEffect->getAttribute('flood-color'));
        $this->assertEquals('0.6', $this->oSVGEffect->getAttribute('flood-opacity'));
    }
}
