<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Marker;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Marker\SVGArrowMarker;

/**
 * Class SVGArrowMarkerTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Marker\SVGArrowMarker
 */
final class SVGArrowMarkerTest extends TestCase
{
    private SVGArrowMarker $oSVGMarker;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGMarker = new SVGArrowMarker(10, 10);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGMarker);
    }

    public function test_construct1(): void
    {
        $this->assertEquals('marker', $this->oSVGMarker->getName());
    }

    public function test_construct2(): void
    {
        $this->oSVGMarker = new SVGArrowMarker(10, 10, SVGArrowMarker::FILLED_ARROW_TO_BAR);
        $this->assertEquals('0 0 22 20', $this->oSVGMarker->getAttribute('viewBox'));
    }

    public function test_construct3(): void
    {
        $this->expectWarning();
        $this->oSVGMarker = new SVGArrowMarker(10, 10, 20);
    }
}
