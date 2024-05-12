<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Shapes;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Shapes\SVGShape;

/**
 * Class SVGShapeTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Shapes\SVGShape
 */
final class SVGShapeTest extends TestCase
{
    private SVGShape $oSVGShape;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        // just create a 'dummy' shape element
        $this->oSVGShape = new SVGShape('shape');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGShape);
    }

    public function testSetPathLength(): void
    {
        $this->oSVGShape->setPathLength(200);
        $this->assertEquals('200', $this->oSVGShape->getAttribute('pathLength'));
    }
}
