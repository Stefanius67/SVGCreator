<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Shapes;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Shapes\SVGPolyTrait;

/**
 * Class SVGPolyTraitTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Shapes\SVGPolyTrait
 */
final class SVGPolyTraitTest extends TestCase
{
    // we're simply work with an anonymous class that uses the trait to test....
    private $oSVGPolyTraitContainer;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGPolyTraitContainer = new class {
            use SVGPolyTrait;
        };
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGPolyTraitContainer);
    }

    public function testBuildPoints(): void
    {
        $strPoints = $this->oSVGPolyTraitContainer->buildPoints([1, 2, 3, 4, 5, 6]);
        $this->assertEquals('1 2 3 4 5 6', $strPoints);
        $strPoints = $this->oSVGPolyTraitContainer->buildPoints([[1, 2], [3, 4], [5, 6]]);
        $this->assertEquals('1,2 3,4 5,6', $strPoints);
    }
}
