<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Text;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Text\SVGFont;

/**
 * Class SVGFontTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Text\SVGFont
 */
final class SVGFontTest extends TestCase
{
    private SVGFont $oSVGFont;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGFont = new SVGFont(__DIR__ . '/../testdata/Liberation.svg');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGFont);
    }

    public function test__construct(): void
    {
        $this->assertIsObject($this->oSVGFont);
    }

    public function testGetUnitsPerEm() : void
    {
        $this->assertEquals(2048, $this->oSVGFont->getUnitsPerEm());
    }

    public function testGetAscent() : void
    {
        $this->assertEquals(1638, $this->oSVGFont->getAscent());
    }

    public function testGetDescent() : void
    {
        $this->assertEquals(-410, $this->oSVGFont->getDescent());
    }

    public function testGetCapHeight() : void
    {
        $this->assertEquals(1409, $this->oSVGFont->getCapHeight());
    }

    public function testGetXHeight() : void
    {
        $this->assertEquals(1082, $this->oSVGFont->getXHeight());
    }

    public function testText() : void
    {
        $oText = $this->oSVGFont->text('Test', 72, 0, 0);
        $this->assertEquals('g', $oText->getName());
    }

    public function testTextNoFontLoaded() : void
    {
        $oFont = new SVGFont();
        $this->expectWarning();
        $oFont->text('Test', 72, 0, 0);
    }

    public function testTextMissingGlyph1() : void
    {
        $oFont = new SVGFont(__DIR__ . '/../testdata/LiberationMissingA.svg');
        $oText = $oFont->text('A', 72, 0, 0);
        $this->assertEquals('g', $oText->getName());
    }

    public function testTextMissingGlyph2() : void
    {
        $oFont = new SVGFont(__DIR__ . '/../testdata/LiberationMissingANoMissingGlyph.svg');
        $oText = $oFont->text('A', 72, 0, 0);
        $this->assertEquals('g', $oText->getName());
    }

    public function testTextWidth() : void
    {
        $this->assertEquals(148.04296875, $this->oSVGFont->textWidth('Test', 72));
    }

    public function testTextWidthNoFontLoaded() : void
    {
        $oFont = new SVGFont();
        $this->expectWarning();
        $oFont->textWidth('Test', 72);
    }

    public function testTextWidthMissingGlyph1() : void
    {
        $oFont = new SVGFont(__DIR__ . '/../testdata/LiberationMissingA.svg');
        $this->assertEquals(26.296875, $oFont->textWidth('A', 72));
    }

    public function testTextWidthMissingGlyph2() : void
    {
        $oFont = new SVGFont(__DIR__ . '/../testdata/LiberationMissingANoMissingGlyph.svg');
        $this->assertEquals(40.04296875, $oFont->textWidth('A', 72));
    }

    public function testSymbol() : void
    {
        $oSymbol = $this->oSVGFont->symbol('X', 72);
        $this->assertEquals('symbol', $oSymbol->getName());
    }

    public function testSymbolNoFontLoaded() : void
    {
        $oFont = new SVGFont();
        $this->expectWarning();
        $oFont->symbol('X', 72);
    }

    public function testSymbolMissingGlyph1() : void
    {
        $oFont = new SVGFont(__DIR__ . '/../testdata/LiberationMissingA.svg');
        $oSymbol = $oFont->symbol('A');
        $this->assertEquals('symbol', $oSymbol->getName());
    }

    public function testSymbolMissingGlyph2() : void
    {
        $oFont = new SVGFont(__DIR__ . '/../testdata/LiberationMissingANoMissingGlyph.svg');
        $oSymbol = $oFont->symbol('A', 72);
        $this->assertEquals('symbol', $oSymbol->getName());
    }
}
