<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\SVG;
use SKien\SVGCreator\SVGSymbol;
use SKien\SVGCreator\Filter\SVGSaturationFilter;
use SKien\SVGCreator\Gradients\SVGSimpleGradient;
use SKien\SVGCreator\Marker\SVGBasicMarker;
use SKien\SVGCreator\Shapes\SVGCircle;

/**
 * Class SVGTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\SVG
 */
final class SVGTest extends TestCase
{
    private SVG $oSVG;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVG = new SVG();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVG);
    }

    public function testSetIsPrettyOutput(): void
    {
        $this->oSVG->setPrettyOutput(true);
        $this->assertTrue($this->oSVG->isPrettyOutput());
        $this->oSVG->setPrettyOutput(false);
        $this->assertFalse($this->oSVG->isPrettyOutput());
    }

    public function testSetSize(): void
    {
        $this->oSVG->setSize(500, 100);
        $this->assertEquals('500', $this->oSVG->getAttribute('width'));
        $this->assertEquals('100', $this->oSVG->getAttribute('height'));
    }

    public function testAddFilter(): void
    {
        $oFilter = $this->oSVG->addFilter(new SVGSaturationFilter(0.5));
        $this->assertIsObject($oFilter);
        $strID = $oFilter->getID();
        $this->assertNotEmpty($strID);
    }

    public function testAddGradient(): void
    {
        $oGradient = $this->oSVG->addGradient(new SVGSimpleGradient('blue', 'red'));
        $this->assertIsObject($oGradient);
        $strID = $oGradient->getID();
        $this->assertNotEmpty($strID);
    }

    public function testAddMarker(): void
    {
        $oMarker = $this->oSVG->addMarker(new SVGBasicMarker(SVGBasicMarker::DOT));
        $this->assertIsObject($oMarker);
        $strID = $oMarker->getID();
        $this->assertNotEmpty($strID);
    }

    public function testAddSymbol(): void
    {
        $oSymbol = $this->oSVG->addSymbol(new SVGSymbol(10, 10));
        $this->assertIsObject($oSymbol);
        $strID = $oSymbol->getID();
        $this->assertNotEmpty($strID);
    }

    public function testAddStyleDef(): void
    {
        // add a style def
        $strStyle = "text {font-size: 256px; font-weight: bold; font-family: 'Arial Black';}";
        $this->oSVG->addStyleDef($strStyle);

        // create the svg, directly read it back into a simpleXML ...
        $oSimpleXML = new \SimpleXMLElement($this->oSVG->getSVG(), LIBXML_NOCDATA);
        // ... and check the 'style' node!
        $this->assertEquals($strStyle, (string) $oSimpleXML->style);
    }

    public function testBuildID(): void
    {
        $this->assertEquals('test1', $this->oSVG->buildID('test'));
        $this->assertEquals('test2', $this->oSVG->buildID('test'));
    }

    /**
     * Have to run in separate process since it writes html header!
     * @runInSeparateProcess
     */
    public function testOutput1(): void
    {
        $this->oSVG->add(new SVGCircle(100, 100, 50));
        ob_start();
        $this->oSVG->output();
        $strSVG = ob_get_contents();
        ob_end_clean();
        $oDOM = new \DOMDocument();
        $this->assertTrue($oDOM->loadXML($strSVG));
    }

    /**
     * Have to run in separate process since it writes html header!
     * @runInSeparateProcess
     */
    public function testOutput2(): void
    {
        $this->oSVG->add(new SVGCircle(100, 100, 50));
        ob_start();
        $this->oSVG->output('test.svg');
        $strSVG = ob_get_contents();
        ob_end_clean();
        $oDOM = new \DOMDocument();
        $this->assertTrue($oDOM->loadXML($strSVG));
    }

    public function testSave(): void
    {
        $this->oSVG->add(new SVGCircle(100, 100, 50));
        $this->oSVG->save( __DIR__ . '/temp/test.svg');
        $oDom = new \DOMDocument();
        $this->assertTrue($oDom->load( __DIR__ . '/temp/test.svg'));
    }
}
