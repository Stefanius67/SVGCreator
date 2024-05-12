<?php

namespace Tests\SKien\SVGCreator\Helper;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Helper\Attrib;

/**
 * Class AttribTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Helper\Attrib
 */
final class AttribTest extends TestCase
{
    private Attrib $attrib;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->attrib = new Attrib();
        $this->attrib['attrib1'] = 'value1';
        $this->attrib['attrib2'] = 10;
        $this->attrib['attrib3'] = 1.5;
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->attrib);
    }

    public function test_construct(): void
    {
        $attrib = new Attrib('attrib1="value1" attrib2="10" attrib3="1.5"');
        $this->assertEquals('value1', $attrib['attrib1']);
        $this->assertEquals('10', $attrib['attrib2']);
        $this->assertEquals('1.5', $attrib['attrib3']);

        $attrib = new Attrib(['attrib1' => 'value1', 'attrib2' => 10, 'attrib3' => 1.5]);
        $this->assertEquals('value1', $attrib['attrib1']);
        $this->assertEquals('10', $attrib['attrib2']);
        $this->assertEquals('1.5', $attrib['attrib3']);
    }

    public function testClear(): void
    {
        $this->assertEquals(3, $this->attrib->count());
        $this->attrib->clear();
        $this->assertEquals(0, $this->attrib->count());
    }

    public function test__toString(): void
    {
        $this->assertEquals('attrib1="value1" attrib2="10" attrib3="1.5"', $this->attrib->__toString());
    }

    public function testParse(): void
    {
        $this->attrib->clear();
        $this->attrib->parse('attrib1="value1" attrib2="10" attrib3="1.5"');
        $this->assertEquals('value1', $this->attrib['attrib1']);
        $this->assertEquals('10', $this->attrib['attrib2']);
        $this->assertEquals('1.5', $this->attrib['attrib3']);
    }

    public function testAddToDOMNode(): void
    {
        $oDoc = new \DOMDocument();
        $oDOMElement = $oDoc->createElement('test');
        $oDOMElement = $this->attrib->addToDOMNode($oDOMElement);
        $this->assertEquals('value1',  $oDOMElement->getAttribute('attrib1'));
        $this->assertEquals('10', $oDOMElement->getAttribute('attrib2'));
        $this->assertEquals('1.5', $oDOMElement->getAttribute('attrib3'));
    }
}
