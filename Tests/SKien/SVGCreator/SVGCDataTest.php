<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\SVGCData;

/**
 * Class SVGCDataTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\SVGCData
 */
final class SVGCDataTest extends TestCase
{
    private SVGCData $oSVGCData;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGCData = new SVGCData('test', 'some CData content');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGCData);
    }

    public function test__construct(): void
    {
        $oSVGCData = new SVGCData('test', 'some CData content');
        $this->assertIsObject($oSVGCData);
        $this->assertEquals('some CData content', $oSVGCData->getData());
    }

    public function testSetGetData(): void
    {
        $this->oSVGCData->setData('new contents');
        $this->assertEquals('new contents', $this->oSVGCData->getData());
    }

    /**
     * the protected method createDOMNode() is called through the parents
     * appendToDOM() method.
     */
    public function testCreateDOMNode(): void
    {
        $oDoc = new \DOMDocument();
        $oDOMElement = $this->oSVGCData->appendToDOM($oDoc);
        $this->assertIsObject($oDOMElement);
        $this->assertEquals('test', $oDOMElement->nodeName);
        $this->assertEquals(XML_CDATA_SECTION_NODE, $oDOMElement->firstChild->nodeType);
        $this->assertEquals('some CData content', $oDOMElement->firstChild->textContent);

        // for empty instances no DOM should be created
        $this->oSVGCData->setData('');
        $this->assertFalse($this->oSVGCData->appendToDOM($oDoc));
    }
}
