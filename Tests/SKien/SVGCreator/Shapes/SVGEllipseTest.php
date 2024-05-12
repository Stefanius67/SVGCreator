<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Shapes;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Shapes\SVGEllipse;

/**
 * Class SVGEllipseTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Shapes\SVGEllipse
 */
final class SVGEllipseTest extends TestCase
{
    private SVGEllipse $oSVGEllipse;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEllipse = new SVGEllipse(100, 200, 40, 60);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGEllipse);
    }

    public function test__construct(): void
    {
        $this->assertEquals('ellipse', $this->oSVGEllipse->getName());
        $this->assertEquals('100', $this->oSVGEllipse->getAttribute('cx'));
        $this->assertEquals('200', $this->oSVGEllipse->getAttribute('cy'));
        $this->assertEquals('40', $this->oSVGEllipse->getAttribute('rx'));
        $this->assertEquals('60', $this->oSVGEllipse->getAttribute('ry'));
    }
}
