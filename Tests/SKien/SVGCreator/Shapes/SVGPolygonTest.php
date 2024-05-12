<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Shapes;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Shapes\SVGPolygon;

/**
 * Class SVGPolygonTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Shapes\SVGPolygon
 */
final class SVGPolygonTest extends TestCase
{
    private SVGPolygon $oSVGPolygon;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGPolygon = new SVGPolygon([1, 2, 3, 4, 5]);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGPolygon);
    }

    public function test__construct(): void
    {
        $this->assertEquals('polygon', $this->oSVGPolygon->getName());
        $this->assertEquals('1 2 3 4 5', $this->oSVGPolygon->getAttribute('points'));
    }
}
