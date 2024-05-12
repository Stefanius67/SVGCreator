<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGCompositeEffect;

/**
 * Class SVGCompositeEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGCompositeEffect
 */
final class SVGCompositeEffectTest extends TestCase
{
    private SVGCompositeEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new SVGCompositeEffect('in1', 'in2', 'arithmetic', 1, 2, 3, 4);
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
        $this->assertEquals('feComposite', $this->oSVGEffect->getName());

        $this->assertEquals('in1', $this->oSVGEffect->getAttribute('in'));
        $this->assertEquals('in2', $this->oSVGEffect->getAttribute('in2'));
        $this->assertEquals('arithmetic', $this->oSVGEffect->getAttribute('operator'));
        $this->assertEquals('1', $this->oSVGEffect->getAttribute('k1'));
        $this->assertEquals('2', $this->oSVGEffect->getAttribute('k2'));
        $this->assertEquals('3', $this->oSVGEffect->getAttribute('k3'));
        $this->assertEquals('4', $this->oSVGEffect->getAttribute('k4'));
    }
}
