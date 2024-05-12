<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\SVGGroup;

/**
 * Class SVGGroupTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\SVGGroup
 */
final class SVGGroupTest extends TestCase
{
    private SVGGroup $oSVGGroup;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGGroup = new SVGGroup();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGGroup);
    }

    public function test__construct(): void
    {
        $this->assertIsObject($this->oSVGGroup);
        $this->assertEquals('g', $this->oSVGGroup->getName());
    }
}
