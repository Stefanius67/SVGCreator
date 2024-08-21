<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\SVGSymbol;

/**
 * Class SVGSymbolTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\SVGSymbol
 */
final class SVGSymbolTest extends TestCase
{
    private SVGSymbol $oSVGSymbol;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGSymbol = new SVGSymbol(100, 100);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGSymbol);
    }

    public function test__construct(): void
    {
        $oSVGSymbol = new SVGSymbol(100, 100);
        $this->assertIsObject($oSVGSymbol);
        $this->assertEquals('symbol', $oSVGSymbol->getName());
    }

    public function testSetRefPoint(): void
    {
        $this->expectNotice();
        $this->oSVGSymbol->setRefPoint(100, 100);
    }
}
