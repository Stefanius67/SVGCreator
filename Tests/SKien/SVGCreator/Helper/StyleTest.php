<?php

namespace Tests\SKien\SVGCreator\Helper;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Helper\Style;

/**
 * Class StyleTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Helper\Style
 */
final class StyleTest extends TestCase
{
    private Style $style;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->style = new Style();
        $this->style['style1'] = 'value1';
        $this->style['style2'] = 10;
        $this->style['style3'] = 1.5;
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->style);
    }

    public function test_construct(): void
    {
        $style = new Style('style1: value1; style2: 10; style3: 1.5');
        $this->assertEquals('value1', $style['style1']);
        $this->assertEquals('10', $style['style2']);
        $this->assertEquals('1.5', $style['style3']);

        $style = new Style(['style1' => 'value1', 'style2' => 10, 'style3' => 1.5]);
        $this->assertEquals('value1', $style['style1']);
        $this->assertEquals('10', $style['style2']);
        $this->assertEquals('1.5', $style['style3']);
    }

    public function testClear(): void
    {
        $this->assertEquals(3, $this->style->count());
        $this->style->clear();
        $this->assertEquals(0, $this->style->count());
    }

    public function test__toString(): void
    {
        $this->assertEquals('style1: value1; style2: 10; style3: 1.5;', $this->style->__toString());
    }

    public function testParse(): void
    {
        $this->style->clear();
        $this->style->parse('style1: value1; style2: 10; style3: 1.5');
        $this->assertEquals('value1', $this->style['style1']);
        $this->assertEquals('10', $this->style['style2']);
        $this->assertEquals('1.5', $this->style['style3']);
    }

    public function testAddToDOMNode(): void
    {
        $oDoc = new \DOMDocument();
        $oDOMElement = $oDoc->createElement('test');
        $oDOMElement = $this->style->addToDOMNode($oDOMElement);
        $this->assertEquals('style1: value1; style2: 10; style3: 1.5;', $oDOMElement->getAttribute('style'));
    }
}
