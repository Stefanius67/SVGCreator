<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGEffect;

/**
 * Class SVGEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGEffect
 */
final class SVGEffectTest extends TestCase
{
    private SVGEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new SVGEffect('feTest');
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
        $this->assertEquals('feTest', $this->oSVGEffect->getName());
    }

    public function testSetInput(): void
    {
        $this->oSVGEffect->setInput('in');
        $this->assertEquals('in', $this->oSVGEffect->getAttribute('in'));
    }

    public function testSetResult(): void
    {
        $this->oSVGEffect->setResult('result');
        $this->assertEquals('result', $this->oSVGEffect->getAttribute('result'));
    }
}
