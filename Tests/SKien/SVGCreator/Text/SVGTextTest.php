<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Text;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\SVG;
use SKien\SVGCreator\Text\SVGText;

/**
 * Class SVGTextTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Text\SVGText
 */
final class SVGTextTest extends TestCase
{
    private SVGText $oSVGText;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGText = new SVGText(10, 10, 'Text' );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGText);
    }

    public function test__construct(): void
    {
        $this->assertIsObject($this->oSVGText);
        $this->assertEquals('text', $this->oSVGText->getName());
        $this->assertEquals('10', $this->oSVGText->getAttribute('x'));
        $this->assertEquals('10', $this->oSVGText->getAttribute('y'));
    }

    public function testSetFontSize(): void
    {
        $this->oSVGText->setFontSize(48);
        $this->assertEquals('48', $this->oSVGText->getAttribute('font-size'));
    }

    public function testSetFontWeight(): void
    {
        $this->oSVGText->setFontWeight('bold');
        $this->assertEquals('bold', $this->oSVGText->getAttribute('font-weight'));
    }

    public function testSetTextAlign(): void
    {
        $this->oSVGText->setTextAlign(SVG::ALIGN_MIDDLE);
        $this->assertEquals('middle', $this->oSVGText->getAttribute('text-anchor'));
        $this->expectWarning();
        $this->oSVGText->setTextAlign(SVGText::STYLE_ALIGN_MIDDLE);
    }

    public function testSetVAlign(): void
    {
        $this->oSVGText->setVAlign(SVG::ALIGN_MIDDLE);
        $this->assertEquals('middle', $this->oSVGText->getAttribute('dominant-baseline'));
        $this->expectWarning();
        $this->oSVGText->setVAlign(SVGText::STYLE_VALIGN_HANGING);
    }

    public function testSetRotation(): void
    {
        $this->oSVGText->setRotation(60);
        $this->assertEquals('60', $this->oSVGText->getAttribute('rotate'));
    }

    public function testSetTextLength(): void
    {
        $this->oSVGText->setTextLength(200);
        $this->assertEquals('200', $this->oSVGText->getAttribute('textLength'));
    }

    public function testSetLengthAdjust(): void
    {
        $this->oSVGText->setLengthAdjust(SVG::LENGTH_ADJUST_SPACING);
        $this->assertEquals('spacing', $this->oSVGText->getAttribute('lengthAdjust'));
    }

    public function testShift(): void
    {
        $this->oSVGText->shift(10, 20);
        $this->assertEquals('10', $this->oSVGText->getAttribute('cx'));
        $this->assertEquals('20', $this->oSVGText->getAttribute('cy'));
    }
}
