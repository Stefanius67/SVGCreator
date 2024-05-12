<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Shapes;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Shapes\SVGCircle;

/**
 * Class SVGCircleTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Shapes\SVGCircle
 */
final class SVGCircleTest extends TestCase
{
    private SVGCircle $oSVGCircle;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGCircle = new SVGCircle(100, 200, 50);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGCircle);
    }

    public function test__construct(): void
    {
        $this->assertIsObject($this->oSVGCircle);
        $this->assertEquals('circle', $this->oSVGCircle->getName());
        $this->assertEquals('100', $this->oSVGCircle->getAttribute('cx'));
        $this->assertEquals('200', $this->oSVGCircle->getAttribute('cy'));
        $this->assertEquals('50', $this->oSVGCircle->getAttribute('r'));
    }
}
