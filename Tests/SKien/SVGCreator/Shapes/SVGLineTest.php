<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Shapes;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Shapes\SVGLine;

/**
 * Class SVGLineTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Shapes\SVGLine
 */
final class SVGLineTest extends TestCase
{
    private SVGLine $oSVGLine;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGLine = new SVGLine(10, 20, 100, 200);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGLine);
    }

    public function test__construct(): void
    {
        $this->assertEquals('line', $this->oSVGLine->getName());
        $this->assertEquals('10', $this->oSVGLine->getAttribute('x1'));
        $this->assertEquals('20', $this->oSVGLine->getAttribute('y1'));
        $this->assertEquals('100', $this->oSVGLine->getAttribute('x2'));
        $this->assertEquals('200', $this->oSVGLine->getAttribute('y2'));
    }
}
