<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGOffsetEffect;

/**
 * Class SVGOffsetEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGOffsetEffect
 */
final class SVGOffsetEffectTest extends TestCase
{
    private SVGOffsetEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new SVGOffsetEffect('in', 10, 20);
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
        $this->assertEquals('feOffset', $this->oSVGEffect->getName());

        $this->assertEquals('in', $this->oSVGEffect->getAttribute('in'));
        $this->assertEquals('10', $this->oSVGEffect->getAttribute('dx'));
        $this->assertEquals('20', $this->oSVGEffect->getAttribute('dy'));
    }
}
