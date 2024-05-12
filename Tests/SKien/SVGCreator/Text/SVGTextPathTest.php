<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Text;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\SVG;
use SKien\SVGCreator\SVGElement;
use SKien\SVGCreator\Text\SVGTextPath;

/**
 * Class SVGTextPathTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Text\SVGTextPath
 */
final class SVGTextPathTest extends TestCase
{
    private SVGTextPath $oSVGTextPath;
    private SVGElement  $oPath;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGTextPath = new SVGTextPath('path1', 'Text');
        $this->oPath = $this->oSVGTextPath->getChildByName('textPath');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGTextPath);
    }

    public function test__construct(): void
    {
        $this->assertIsObject($this->oSVGTextPath);
        $this->assertEquals('text', $this->oSVGTextPath->getName());
        $this->assertIsObject($this->oPath);
    }

    public function testSetOffset(): void
    {
        $this->oSVGTextPath->setOffset(20);
        $this->assertEquals('20', $this->oPath->getAttribute('startOffset'));
    }

    public function testSetSide(): void
    {
        $this->oSVGTextPath->setSide(SVG::RENDER_LEFT);
        $this->assertEquals('left', $this->oPath->getAttribute('side'));
    }

    public function testSetTextLength(): void
    {
        $this->oSVGTextPath->setTextLength(100);
        $this->assertEquals('100', $this->oPath->getAttribute('textLength'));
    }

    public function testSetLengthAdjust(): void
    {
        $this->oSVGTextPath->setLengthAdjust(SVG::LENGTH_ADJUST_SPACING_AND_GLYPHS);
        $this->assertEquals('spacingAndGlyphs', $this->oPath->getAttribute('lengthAdjust'));
    }

    public function testSetMethod(): void
    {
        $this->oSVGTextPath->setMethod(SVG::METHOD_STRETCH);
        $this->assertEquals('stretch', $this->oPath->getAttribute('method'));
    }

    public function testSetGlyphSpacing(): void
    {
        $this->oSVGTextPath->setGlyphSpacing(SVG::GLYPH_SPACING_EXACT);
        $this->assertEquals('exact', $this->oPath->getAttribute('spacing'));
    }
}
