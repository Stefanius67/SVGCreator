<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGFloodEffect;

/**
 * Class SVGFloodEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGFloodEffect
 */
final class SVGFloodEffectTest extends TestCase
{
    private SVGFloodEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new SVGFloodEffect('blue', 0.5);
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
        $this->assertEquals('feFlood', $this->oSVGEffect->getName());

        $this->assertEquals('blue', $this->oSVGEffect->getAttribute('flood-color'));
        $this->assertEquals('0.5', $this->oSVGEffect->getAttribute('flood-opacity'));
    }
}
