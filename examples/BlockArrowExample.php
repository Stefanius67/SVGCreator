<?php

/**
 * This example demonstrates the measurement and available types of the blockarrow.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */

declare(strict_types=1);

include '../autoloader.php';

use SKien\SVGCreator\SVG;
use SKien\SVGCreator\ExtShapes\SVGBlockArrow;
use SKien\SVGCreator\ExtShapes\SVGBlockArrowDef;
use SKien\SVGCreator\Marker\SVGArrowMarker;
use SKien\SVGCreator\Marker\SVGMarker;
use SKien\SVGCreator\Shapes\SVGLine;
use SKien\SVGCreator\Text\SVGText;

$iSVGWidth = 800;
$iSVGHeight = 700;

$oSVG = new SVG();
$oSVG->setPrettyOutput(true);
$oSVG->setSize($iSVGWidth, $iSVGHeight);

$oSVG->addStyleDef(".grid {stroke: #999; stroke-width: 1; stroke-dasharray: 1 2;}");
$oSVG->addStyleDef("text {fill: black; text-anchor: middle; font-size: 16px; font-weight: 400; font-style: italic; font-family: 'Arial';}");

$iGrid = 20;
if ($iGrid > 0) {
    for ($x = $iGrid; $x < $iSVGWidth; $x += $iGrid) {
        $oSVG->add(new SVGLine($x, 0, $x, $iSVGHeight, 'grid'));
    }
    for ($y = $iGrid; $y < $iSVGHeight; $y += $iGrid) {
        $oSVG->add(new SVGLine(0, $y, $iSVGWidth, $y, 'grid'));
    }
}

$oMarker = $oSVG->addMarker(new SVGArrowMarker(10, 10));

$oArrowDef = new SVGBlockArrowDef(40, 90, 40, 'fill: #bbb; stroke: blue; stroke-width: 2;');
$oSVG->add(new SVGBlockArrow(100, 200, 300, 200, $oArrowDef));

$oSVG->add(new SVGLine(75, 200, 325, 200, 'stroke: red; stroke-dasharray: 1 3 8 3;'));

$oText = $oSVG->add(new SVGText(150, 120, '(x1,y1)'));
$oLine = new SVGLine(145, 125, 105, 195, 'stroke: black;');
$oLine->setMarker($oMarker, SVGMarker::MARKER_END);
$oSVG->add($oLine);
$oSVG->add(new SVGLine(95, 195, 105, 205, 'stroke: red; stroke-width: 2;'));
$oSVG->add(new SVGLine(95, 205, 105, 195, 'stroke: red; stroke-width: 2;'));

$oText = $oSVG->add(new SVGText(350, 120, '(x2,y2)'));
$oLine = new SVGLine(345, 125, 305, 195, 'stroke: black;');
$oLine->setMarker($oMarker, SVGMarker::MARKER_END);
$oSVG->add($oLine);
$oSVG->add(new SVGLine(295, 195, 305, 205, 'stroke: red; stroke-width: 2;'));
$oSVG->add(new SVGLine(295, 205, 305, 195, 'stroke: red; stroke-width: 2;'));

$oText = $oSVG->add(new SVGText(45, 200, 'height'));
$oText->rotate(-90, 45, 200);
$oLine = new SVGLine(60, 180, 60, 220, 'stroke: red;');
$oLine->setMarker($oMarker, SVGMarker::MARKER_END | SVGMarker::MARKER_START);
$oSVG->add($oLine);
$oSVG->add(new SVGLine(50, 180, 100, 180, 'stroke: red;'));
$oSVG->add(new SVGLine(50, 220, 100, 220, 'stroke: red;'));

$oText = $oSVG->add(new SVGText(365, 200, 'pikeHeight'));
$oText->rotate(-90, 365, 200);
$oLine = new SVGLine(340, 155, 340, 245, 'stroke: red;');
$oLine->setMarker($oMarker, SVGMarker::MARKER_END | SVGMarker::MARKER_START);
$oSVG->add($oLine);
$oSVG->add(new SVGLine(240, 155, 350, 155, 'stroke: red;'));
$oSVG->add(new SVGLine(240, 245, 350, 245, 'stroke: red;'));

$oSVG->add(new SVGText(270, 95, 'pikeLength'));
$oLine = new SVGLine(240, 110, 300, 110, 'stroke: red;');
$oLine->setMarker($oMarker, SVGMarker::MARKER_END | SVGMarker::MARKER_START);
$oSVG->add($oLine);
$oSVG->add(new SVGLine(240, 100, 240, 155, 'stroke: red;'));
$oSVG->add(new SVGLine(300, 100, 300, 200, 'stroke: red;'));


$oSVG->add(new SVGBlockArrow(560, 220, 460, 120, $oArrowDef, SVGBlockArrow::SINGLE));

$oSVG->add(new SVGLine(580, 240, 440, 100, 'stroke: red; stroke-dasharray: 1 3 8 3;'));

$oText = $oSVG->add(new SVGText(560, 250, '(x1,y1)'));
$oSVG->add(new SVGLine(560, 215, 560, 225, 'stroke: red; stroke-width: 2;'));
$oSVG->add(new SVGLine(555, 220, 565, 220, 'stroke: red; stroke-width: 2;'));

$oText = $oSVG->add(new SVGText(475, 105, '(x2,y2)'));
$oSVG->add(new SVGLine(460, 125, 460, 115, 'stroke: red; stroke-width: 2;'));
$oSVG->add(new SVGLine(455, 120, 465, 120, 'stroke: red; stroke-width: 2;'));

$oArrowDef2 = new SVGBlockArrowDef(10, 20, 10, 'fill: #bbb; stroke: blue; stroke-width: 2;');

$oSVG->add(new SVGBlockArrow(110, 400, 150, 460, $oArrowDef2, SVGBlockArrow::ANGLED_VERT));
$oSVG->add(new SVGBlockArrow(100, 400,  60, 460, $oArrowDef2, SVGBlockArrow::ANGLED_VERT));
$oSVG->add(new SVGBlockArrow(100, 380,  60, 320, $oArrowDef2, SVGBlockArrow::ANGLED_VERT));
$oSVG->add(new SVGBlockArrow(110, 380, 150, 320, $oArrowDef2, SVGBlockArrow::ANGLED_VERT));

$oSVG->add(new SVGBlockArrow(300, 395, 360, 435, $oArrowDef2, SVGBlockArrow::ANGLED_HORZ));
$oSVG->add(new SVGBlockArrow(280, 395, 220, 435, $oArrowDef2, SVGBlockArrow::ANGLED_HORZ));
$oSVG->add(new SVGBlockArrow(280, 385, 220, 345, $oArrowDef2, SVGBlockArrow::ANGLED_HORZ));
$oSVG->add(new SVGBlockArrow(300, 385, 360, 345, $oArrowDef2, SVGBlockArrow::ANGLED_HORZ));

$oSVG->add(new SVGBlockArrow(480, 400, 540, 440, $oArrowDef2, SVGBlockArrow::ANGLED_DOUBLE));
$oSVG->add(new SVGBlockArrow(470, 400, 410, 440, $oArrowDef2, SVGBlockArrow::ANGLED_DOUBLE));
$oSVG->add(new SVGBlockArrow(470, 380, 410, 340, $oArrowDef2, SVGBlockArrow::ANGLED_DOUBLE));
$oSVG->add(new SVGBlockArrow(480, 380, 540, 340, $oArrowDef2, SVGBlockArrow::ANGLED_DOUBLE));

$oSVG->add(new SVGBlockArrow(110, 600, 150, 660, $oArrowDef2, SVGBlockArrow::ROUNDED_VERT));
$oSVG->add(new SVGBlockArrow(100, 600,  60, 660, $oArrowDef2, SVGBlockArrow::ROUNDED_VERT));
$oSVG->add(new SVGBlockArrow(100, 580,  60, 520, $oArrowDef2, SVGBlockArrow::ROUNDED_VERT));
$oSVG->add(new SVGBlockArrow(110, 580, 150, 520, $oArrowDef2, SVGBlockArrow::ROUNDED_VERT));

$oSVG->add(new SVGBlockArrow(300, 595, 360, 635, $oArrowDef2, SVGBlockArrow::ROUNDED_HORZ));
$oSVG->add(new SVGBlockArrow(280, 595, 220, 635, $oArrowDef2, SVGBlockArrow::ROUNDED_HORZ));
$oSVG->add(new SVGBlockArrow(280, 585, 220, 545, $oArrowDef2, SVGBlockArrow::ROUNDED_HORZ));
$oSVG->add(new SVGBlockArrow(300, 585, 360, 545, $oArrowDef2, SVGBlockArrow::ROUNDED_HORZ));

$oSVG->add(new SVGBlockArrow(480, 600, 540, 640, $oArrowDef2, SVGBlockArrow::ROUNDED_DOUBLE));
$oSVG->add(new SVGBlockArrow(470, 600, 410, 640, $oArrowDef2, SVGBlockArrow::ROUNDED_DOUBLE));
$oSVG->add(new SVGBlockArrow(470, 580, 410, 540, $oArrowDef2, SVGBlockArrow::ROUNDED_DOUBLE));
$oSVG->add(new SVGBlockArrow(480, 580, 540, 540, $oArrowDef2, SVGBlockArrow::ROUNDED_DOUBLE));

$oSVG->output();