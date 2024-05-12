<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\SVG;
use SKien\SVGCreator\SVGComment;

/**
 * Class SVGCommentTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\SVGComment
 */
final class SVGCommentTest extends TestCase
{
    private SVGComment $oSVGComment;

    private string $strComment;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->strComment = 'a comment to the element';
        $this->oSVGComment = new SVGComment($this->strComment);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGComment);
        unset($this->strComment);
    }

    public function test__construct(): void
    {
        $oSVGComment = new SVGComment($this->strComment);
        $this->assertIsObject($oSVGComment);
    }

    public function testAppendToDOM(): void
    {
        $oDoc = new \DOMDocument();

        // no DOM node without valid root
        $this->assertFalse($this->oSVGComment->appendToDOM($oDoc));

        $oSVG = new SVG();
        $oSVG->add($this->oSVGComment);

        // still no DOM node as long as SVG's 'PrettyOutput' is not activated
        $this->assertFalse($this->oSVGComment->appendToDOM($oDoc));

        $oSVG->setPrettyOutput(true);

        // now we should get a DOM comment node
        $oDOMElement = $this->oSVGComment->appendToDOM($oDoc);
        $this->assertIsObject($oDOMElement);
        $this->assertEquals(XML_COMMENT_NODE, $oDOMElement->nodeType);
        $this->assertEquals($this->strComment, $oDOMElement->textContent);
    }
}
