<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGGaussianBlurEffect;

/**
 * Class SVGGaussianBlurEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGGaussianBlurEffect
 */
final class SVGGaussianBlurEffectTest extends TestCase
{
    private SVGGaussianBlurEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new SVGGaussianBlurEffect('in', 5, 'duplicate');
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
        $this->assertEquals('feGaussianBlur', $this->oSVGEffect->getName());

        $this->assertEquals('in', $this->oSVGEffect->getAttribute('in'));
        $this->assertEquals('5', $this->oSVGEffect->getAttribute('stdDeviation'));
        $this->assertEquals('duplicate', $this->oSVGEffect->getAttribute('edgeMode'));
    }
}
