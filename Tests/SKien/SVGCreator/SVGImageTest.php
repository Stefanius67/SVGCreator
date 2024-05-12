<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\SVGImage;

/**
 * Class SVGImageTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\SVGImage
 */
final class SVGImageTest extends TestCase
{
    private SVGImage $oSVGImage;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGImage = new SVGImage(0, 0, 100, 100,  __DIR__ . '/testdata/elephpant.png');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGImage);
    }

    public function test__construct(): void
    {
        $this->assertIsObject($this->oSVGImage);
        $this->assertEquals('image', $this->oSVGImage->getName());
    }
}
