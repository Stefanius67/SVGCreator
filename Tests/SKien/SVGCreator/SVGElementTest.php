<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\SVG;
use SKien\SVGCreator\SVGElement;
use SKien\SVGCreator\Filter\SVGSaturationFilter;
use SKien\SVGCreator\Gradients\SVGSimpleGradient;

/**
 * Class SVGElementTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\SVGElement
 */
final class SVGElementTest extends TestCase
{
    private SVGElement $oSVGElement;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGElement = new SVGElement('testName', 'testValue', 'testClass');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGElement);
    }

    public function testConstruct(): void
    {
        $oSVGElement = new SVGElement('testName', 'testValue', 'testClass');
        $this->assertEquals('testName', $oSVGElement->getName());
        $this->assertEquals('testValue', $oSVGElement->getValue());
        $this->assertEquals('testClass', $oSVGElement->getAttribute('class'));
    }

    public function testSetValue(): void
    {
        $this->oSVGElement->setValue('newValue');
        $this->assertEquals('newValue', $this->oSVGElement->getValue());
    }

    public function testSetStyleOrClass(): void
    {
        $this->assertEquals('testClass', $this->oSVGElement->getAttribute('class'));
        $this->oSVGElement->setStyleOrClass('newClass');
        $this->assertEquals('newClass', $this->oSVGElement->getAttribute('class'));

        $this->assertEmpty($this->oSVGElement->getStyle());
        $this->oSVGElement->setStyleOrClass('testName: testValue');
        $this->assertEquals('testName: testValue;', $this->oSVGElement->getStyle());
        $this->assertEquals('testValue', $this->oSVGElement->getStyle('testName'));
    }

    public function testSetStyle(): void
    {
        $this->assertEmpty($this->oSVGElement->getStyle());
        $this->oSVGElement->setStyle('testName: testValue');
        $this->assertEquals('testName: testValue;', $this->oSVGElement->getStyle());
        $this->assertEquals('testValue', $this->oSVGElement->getStyle('testName'));
    }

    public function testAddStyle(): void
    {
        $this->assertEmpty($this->oSVGElement->getStyle());
        $this->oSVGElement->setStyle('testName1: testValue1');
        $this->oSVGElement->addStyle('testName2', 'testValue2');
        $this->assertEquals('testValue1', $this->oSVGElement->getStyle('testName1'));
        $this->assertEquals('testValue2', $this->oSVGElement->getStyle('testName2'));
    }

    public function testAddComment(): void
    {
        $this->oSVGElement->setValue('');
        $this->oSVGElement->addComment('a comment');

        $oSVG = new SVG();
        $oSVG->add($this->oSVGElement);
        $oSVG->setPrettyOutput(true);

        $oDoc = new \DOMDocument();
        $oDOMElement = $this->oSVGElement->appendToDOM($oDoc);
        $this->assertIsObject($oDOMElement);
        $this->assertIsObject($oDOMElement->firstChild);
        $this->assertEquals(XML_COMMENT_NODE, $oDOMElement->firstChild->nodeType);
        $this->assertEquals('a comment', $oDOMElement->firstChild->textContent);
    }

    public function testSetTitle(): void
    {
        $this->oSVGElement->setTitle('title of the element');
        $oTitle = $this->oSVGElement->getChildByName('title');
        $this->assertIsObject($oTitle);
        $this->assertEquals('title of the element', $oTitle->getValue());
        $this->oSVGElement->setTitle('new title');
        $this->assertEquals('new title', $oTitle->getValue());
    }

    public function testAppendToDOM(): void
    {
        $this->oSVGElement->setAttribute('attrib1', 'value1');
        $this->oSVGElement->setAttribute('attrib2', 1.23);
        $oDoc = new \DOMDocument();
        $oDOMElement = $this->oSVGElement->appendToDOM($oDoc);
        $this->assertEquals('value1', $oDOMElement->getAttribute('attrib1'));
        $this->assertEquals('1.23', $oDOMElement->getAttribute('attrib2'));
    }

    /* -------------------------- test for the SVGAttributesTrait -----------*/

    public function testSetGetHasAttribute() : void
    {
        // set two attributes
        $this->oSVGElement->setAttribute('attrib1', 'value1');
        $this->oSVGElement->setAttribute('attrib2', 1.23);

        // test for
        $this->assertTrue($this->oSVGElement->hasAttribute('attrib1'));
        $this->assertEquals('value1', $this->oSVGElement->getAttribute('attrib1'));
        $this->assertEquals('1.23', $this->oSVGElement->getAttribute('attrib2'));

        // set prev attribute with null value
        $this->oSVGElement->setAttribute('attrib1', null);
        // test, if old value still set
        $this->assertEquals('value1', $this->oSVGElement->getAttribute('attrib1'));

        // reset prev attribute
        $this->oSVGElement->setAttribute('attrib1', null, true);
        // test, if attribute removed
        $this->assertFalse($this->oSVGElement->hasAttribute('attrib1'));
    }

    public function testSetGetID() : void
    {
        // set ID and test for
        $this->oSVGElement->setID('newID');
        $this->assertEquals('newID', $this->oSVGElement->getID());
    }

    public function testSetFillColor() : void
    {
        // set value and test for
        $this->oSVGElement->setFillColor('newColor');
        $this->assertEquals('newColor', $this->oSVGElement->getAttribute('fill'));
    }

    public function testSetStrokeColor() : void
    {
        // set value and test for
        $this->oSVGElement->setStrokeColor('newColor');
        $this->assertEquals('newColor', $this->oSVGElement->getAttribute('stroke'));
    }

    public function testSetStrokeWidth() : void
    {
        // set value and test for
        $this->oSVGElement->setStrokeWidth(4);
        $this->assertEquals('4', $this->oSVGElement->getAttribute('stroke-width'));
    }

    public function testSetDashArray() : void
    {
        // set value using both supported types
        $this->oSVGElement->setDashArray('1 2 3 4');
        $this->assertEquals('1 2 3 4', $this->oSVGElement->getAttribute('stroke-dasharray'));
        $this->oSVGElement->setDashArray([1, 2, 3, 4]);
        $this->assertEquals('1 2 3 4', $this->oSVGElement->getAttribute('stroke-dasharray'));
    }

    public function testSetClass() : void
    {
        $this->assertEquals('testClass', $this->oSVGElement->getAttribute('class'));
        $this->oSVGElement->setClass('newClass');
        $this->assertEquals('newClass', $this->oSVGElement->getAttribute('class'));
    }

    public function testSetPreserveAspectRatio(): void
    {
        $this->oSVGElement->setPreserveAspectRatio('xMinYMin');
        $this->assertEquals('xMinYMin', $this->oSVGElement->getAttribute('preserveAspectRatio'));
    }

    public function testSetPos(): void
    {
        $this->oSVGElement->setPos(100, 200);
        $this->assertEquals('100', $this->oSVGElement->getAttribute('x'));
        $this->assertEquals('200', $this->oSVGElement->getAttribute('y'));
    }

    public function testSetSize(): void
    {
        $this->oSVGElement->setSize(1000, 2000);
        $this->assertEquals('1000', $this->oSVGElement->getAttribute('width'));
        $this->assertEquals('2000', $this->oSVGElement->getAttribute('height'));
    }

    public function testSetLanguage() : void
    {
        // set value and test for
        $this->oSVGElement->setLanguage('de');
        $this->assertEquals('de', $this->oSVGElement->getAttribute('systemLanguage'));
    }

    public function testTranslate() : void
    {
        $this->oSVGElement->translate(10, 20);
        $this->assertStringContainsString('translate(10, 20)', $this->oSVGElement->getAttribute('transform'));
    }

    public function testScale() : void
    {
        $this->oSVGElement->scale(2, 2);
        // Set another transformation to ensure that the previous one is not overwritten
        $this->oSVGElement->translate(10, 20);
        $this->assertStringContainsString('scale(2, 2)', $this->oSVGElement->getAttribute('transform'));

        $this->oSVGElement->setAttribute('transform', null, true);
        $this->assertFalse($this->oSVGElement->hasAttribute('transform'));
        $this->oSVGElement->scale(0.5, 0.5, 100, 200);
        $this->assertStringContainsString('scale(0.5, 0.5)', $this->oSVGElement->getAttribute('transform'));
        $this->assertEquals('100 200', $this->oSVGElement->getAttribute('transform-origin'));
    }

    public function testFlipHorz() : void
    {
        $this->oSVGElement->flipHorz();
        $this->assertStringContainsString('scale(-1, 1)', $this->oSVGElement->getAttribute('transform'));
    }

    public function testFlipVert() : void
    {
        $this->oSVGElement->flipVert();
        $this->assertStringContainsString('scale(1, -1)', $this->oSVGElement->getAttribute('transform'));
    }

    public function testRotate() : void
    {
        $this->oSVGElement->rotate(30);
        $this->assertStringContainsString('rotate(30)', $this->oSVGElement->getAttribute('transform'));

        $this->oSVGElement->setAttribute('transform', null, true);
        $this->assertFalse($this->oSVGElement->hasAttribute('transform'));
        $this->oSVGElement->rotate(30, 200, 100);
        $this->assertStringContainsString('rotate(30)', $this->oSVGElement->getAttribute('transform'));
        $this->assertEquals('200 100', $this->oSVGElement->getAttribute('transform-origin'));
    }

    public function testSkewX() : void
    {
        $this->oSVGElement->skewX(20);
        $this->assertStringContainsString('skewX(20)', $this->oSVGElement->getAttribute('transform'));
    }

    public function testSkewY() : void
    {
        $this->oSVGElement->skewY(10);
        $this->assertStringContainsString('skewY(10)', $this->oSVGElement->getAttribute('transform'));
    }

    public function testMatrix() : void
    {
        $this->oSVGElement->matrix('1 2 3 4 5 6');
        $this->assertStringContainsString('matrix(1 2 3 4 5 6)', $this->oSVGElement->getAttribute('transform'));
        $this->oSVGElement->setAttribute('transform', null, true);
        $this->assertFalse($this->oSVGElement->hasAttribute('transform'));
        $this->oSVGElement->matrix([1,2,3,4,5,6]);
        $this->assertStringContainsString('matrix(1 2 3 4 5 6)', $this->oSVGElement->getAttribute('transform'));
    }

    public function testSetFilter() : void
    {
        $this->oSVGElement->setFilter('filterID');
        $this->assertEquals('url(#filterID)', $this->oSVGElement->getAttribute('filter'));

        $oFilter = new SVGSaturationFilter(0.5);
        $oFilter->setID('myID');
        $this->oSVGElement->setFilter($oFilter);
        $this->assertEquals('url(#myID)', $this->oSVGElement->getAttribute('filter'));
    }

    public function testSetGradient() : void
    {
        $this->oSVGElement->setGradient('gradientID');
        $this->assertEquals('url(#gradientID)', $this->oSVGElement->getAttribute('fill'));

        $oGrad = new SVGSimpleGradient('red', 'blue');
        $oGrad->setID('myID');
        $this->oSVGElement->setGradient($oGrad);
        $this->assertEquals('url(#myID)', $this->oSVGElement->getAttribute('fill'));
    }

    public function testSetClipPath() : void
    {
        $this->oSVGElement->setClipPath('pathID');
        $this->assertEquals('url(#pathID)', $this->oSVGElement->getAttribute('clip-path'));

        $oPath = new SVGElement('clipPath');
        $oPath->setID('myID');
        $this->oSVGElement->setClipPath($oPath);
        $this->assertEquals('url(#myID)', $this->oSVGElement->getAttribute('clip-path'));
    }
}
