<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\ExtShapes;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\ExtShapes\SVGStar;

/**
 * Class SVGStarTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\ExtShapes\SVGStar
 */
final class SVGStarTest extends TestCase
{
    private SVGStar $oSVGStar;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        // just create a 'dummy' shape element
        $this->oSVGStar = new SVGStar(4, 200, 100, 200, 200);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGStar);
    }

    public function testConstruct(): void
    {
        $this->assertIsObject($this->oSVGStar);
    }

    public function testDrawCircumRadiuses(): void
    {
        $oPath = $this->oSVGStar->drawCircumRadiuses();
        $this->assertEquals('M 200 200 L 200 0 Z M 200 200 L 0 200 Z M 200 200 L 200 400 Z M 200 200 L 400 200 Z', trim($oPath->getAttribute('d')));
    }

    public function testDrawIncircleRadiuses(): void
    {
        $oPath = $this->oSVGStar->drawIncircleRadiuses();
        $this->assertEquals('M 200 200 L 129.289 129.289 Z M 200 200 L 129.289 270.711 Z M 200 200 L 270.711 270.711 Z M 200 200 L 270.711 129.289 Z', trim($oPath->getAttribute('d')));
    }

    public function testDraw3D(): void
    {
        $oPath = $this->oSVGStar->draw3D();
        $this->assertEquals('M 200 200 L 200 0 L 129.289 129.289 Z M 200 200 L 0 200 L 129.289 270.711 Z M 200 200 L 200 400 L 270.711 270.711 Z M 200 200 L 400 200 L 270.711 129.289 Z', trim($oPath->getAttribute('d')));
    }
}
