<?php

/**
 * This example demonstrates the usage of markers.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */

declare(strict_types=1);

include 'autoloader.php';

use SKien\SVGCreator\SVG;
use SKien\SVGCreator\Marker\SVGArrowMarker;
use SKien\SVGCreator\Marker\SVGBasicMarker;
use SKien\SVGCreator\Marker\SVGMarker;
use SKien\SVGCreator\Shapes\SVGLine;
use SKien\SVGCreator\Text\SVGText;

$oSVG = new SVG();
$oSVG->setPrettyOutput(true);
$oSVG->setSize(500, 350);
$oSVG->setViewbox(0, 0, 1000, 700);

$oSVG->addStyleDef("text {font-size: 24px; font-weight: normal; font-family: 'Arial';}");
$oSVG->addStyleDef("rect {stroke: black; stroke-width: 2;}");

$oMarker1 = $oSVG->addMarker(new SVGArrowMarker(10, 10, SVGArrowMarker::FILLED_ARROW));
$oMarker2 = $oSVG->addMarker(new SVGArrowMarker( 5, 10, SVGArrowMarker::FILLED_ARROW));
$oMarker3 = $oSVG->addMarker(new SVGArrowMarker(15, 10, SVGArrowMarker::FILLED_ARROW));
$oMarker4 = $oSVG->addMarker(new SVGArrowMarker(10, 10, SVGArrowMarker::FILLED_ARROW_TO_BAR));
$oMarker5 = $oSVG->addMarker(new SVGArrowMarker( 5, 10, SVGArrowMarker::FILLED_ARROW_TO_BAR));
$oMarker6 = $oSVG->addMarker(new SVGArrowMarker(15, 10, SVGArrowMarker::FILLED_ARROW_TO_BAR));

$oMarker11 = $oSVG->addMarker(new SVGArrowMarker(10, 10, SVGArrowMarker::LINE_ARROW));
$oMarker12 = $oSVG->addMarker(new SVGArrowMarker( 5, 10, SVGArrowMarker::LINE_ARROW));
$oMarker13 = $oSVG->addMarker(new SVGArrowMarker(15, 10, SVGArrowMarker::LINE_ARROW));
$oMarker14 = $oSVG->addMarker(new SVGArrowMarker(10, 10, SVGArrowMarker::LINE_ARROW_TO_BAR));
$oMarker15 = $oSVG->addMarker(new SVGArrowMarker( 5, 10, SVGArrowMarker::LINE_ARROW_TO_BAR));
$oMarker16 = $oSVG->addMarker(new SVGArrowMarker(15, 10, SVGArrowMarker::LINE_ARROW_TO_BAR));

$oMarker21 = $oSVG->addMarker(new SVGArrowMarker(10, 10, SVGArrowMarker::HARPOON_ARROW));
$oMarker22 = $oSVG->addMarker(new SVGArrowMarker( 5, 10, SVGArrowMarker::HARPOON_ARROW));
$oMarker23 = $oSVG->addMarker(new SVGArrowMarker(15, 10, SVGArrowMarker::HARPOON_ARROW));
$oMarker24 = $oSVG->addMarker(new SVGArrowMarker(10, 10, SVGArrowMarker::HARPOON_ARROW_TO_BAR));
$oMarker25 = $oSVG->addMarker(new SVGArrowMarker( 5, 10, SVGArrowMarker::HARPOON_ARROW_TO_BAR));
$oMarker26 = $oSVG->addMarker(new SVGArrowMarker(15, 10, SVGArrowMarker::HARPOON_ARROW_TO_BAR));

$oSVG->add(new SVGText(100, 80, '10 x 10', SVGText::STYLE_ALIGN_END . SVGText::STYLE_VALIGN_MIDDLE));
$oSVG->add(new SVGText(100, 130, '5 x 10', SVGText::STYLE_ALIGN_END . SVGText::STYLE_VALIGN_MIDDLE));
$oSVG->add(new SVGText(100, 180, '15 x 10', SVGText::STYLE_ALIGN_END . SVGText::STYLE_VALIGN_MIDDLE));
$oSVG->add(new SVGText(100, 230, '10 x 10', SVGText::STYLE_ALIGN_END . SVGText::STYLE_VALIGN_MIDDLE));
$oSVG->add(new SVGText(100, 280, '5 x 10', SVGText::STYLE_ALIGN_END . SVGText::STYLE_VALIGN_MIDDLE));
$oSVG->add(new SVGText(100, 330, '15 x 10', SVGText::STYLE_ALIGN_END . SVGText::STYLE_VALIGN_MIDDLE));

$oSVG->add(new SVGText(235, 40, 'FILLED_ARROW', SVGText::STYLE_ALIGN_MIDDLE));
$oLine = $oSVG->add(new SVGLine(120, 80, 370, 80, 'stroke: blue; stroke-width: 4;'));
$oLine->setMarker($oMarker1, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(120, 130, 370, 130, 'stroke: blue; stroke-width: 4;'));
$oLine->setMarker($oMarker2, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(120, 180, 370, 180, 'stroke: blue; stroke-width: 4;'));
$oLine->setMarker($oMarker3, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(120, 230, 370, 230, 'stroke: blue; stroke-width: 4;'));
$oLine->setMarker($oMarker4, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(120, 280, 370, 280, 'stroke: blue; stroke-width: 4;'));
$oLine->setMarker($oMarker5, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(120, 330, 370, 330, 'stroke: blue; stroke-width: 4;'));
$oLine->setMarker($oMarker6, SVGMarker::MARKER_START | SVGMarker::MARKER_END);

$oSVG->add(new SVGText(535, 40, 'LINE_ARROW', SVGText::STYLE_ALIGN_MIDDLE));
$oLine = $oSVG->add(new SVGLine(420, 80, 670, 80, 'stroke: red; stroke-width: 4;'));
$oLine->setMarker($oMarker11, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(420, 130, 670, 130, 'stroke: red; stroke-width: 4;'));
$oLine->setMarker($oMarker12, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(420, 180, 670, 180, 'stroke: red; stroke-width: 4;'));
$oLine->setMarker($oMarker13, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(420, 230, 670, 230, 'stroke: red; stroke-width: 4;'));
$oLine->setMarker($oMarker14, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(420, 280, 670, 280, 'stroke: red; stroke-width: 4;'));
$oLine->setMarker($oMarker15, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(420, 330, 670, 330, 'stroke: red; stroke-width: 4;'));
$oLine->setMarker($oMarker16, SVGMarker::MARKER_START | SVGMarker::MARKER_END);

$oSVG->add(new SVGText(835, 40, 'HARPOON_ARROW', SVGText::STYLE_ALIGN_MIDDLE));
$oLine = $oSVG->add(new SVGLine(720, 80, 970, 80, 'stroke: green; stroke-width: 4;'));
$oLine->setMarker($oMarker21, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(720, 130, 970, 130, 'stroke: green; stroke-width: 4;'));
$oLine->setMarker($oMarker22, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(720, 180, 970, 180, 'stroke: green; stroke-width: 4;'));
$oLine->setMarker($oMarker23, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(720, 230, 970, 230, 'stroke: green; stroke-width: 4;'));
$oLine->setMarker($oMarker24, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(720, 280, 970, 280, 'stroke: green; stroke-width: 4;'));
$oLine->setMarker($oMarker25, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(720, 330, 970, 330, 'stroke: green; stroke-width: 4;'));
$oLine->setMarker($oMarker26, SVGMarker::MARKER_START | SVGMarker::MARKER_END);

$oMarker31 = $oSVG->addMarker(new SVGBasicMarker(SVGBasicMarker::DOT));
$oMarker32 = $oSVG->addMarker(new SVGBasicMarker(SVGBasicMarker::SQUARE));
$oMarker33 = $oSVG->addMarker(new SVGBasicMarker(SVGBasicMarker::BAR));
$oMarker34 = $oSVG->addMarker(new SVGBasicMarker(SVGBasicMarker::TRIANGLE));
$oMarker35 = $oSVG->addMarker(new SVGBasicMarker(SVGBasicMarker::RHOMBUS));

$oMarker41 = $oSVG->addMarker(new SVGBasicMarker(SVGBasicMarker::DOT, 10, 'yellow', 'black'));
$oMarker42 = $oSVG->addMarker(new SVGBasicMarker(SVGBasicMarker::SQUARE, 7, 'cyan'));
$oMarker43 = $oSVG->addMarker(new SVGBasicMarker(SVGBasicMarker::BAR, 10, 'red', 'black'));
$oMarker44 = $oSVG->addMarker(new SVGBasicMarker(SVGBasicMarker::TRIANGLE, 10, 'none', 'red'));
$oMarker45 = $oSVG->addMarker(new SVGBasicMarker(SVGBasicMarker::RHOMBUS, 5));

$oSVG->add(new SVGText(235, 440, 'Basic Marker', SVGText::STYLE_ALIGN_MIDDLE));
$oLine = $oSVG->add(new SVGLine(120, 480, 370, 480, 'stroke: blue; stroke-width: 3;'));
$oLine->setMarker($oMarker31, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(120, 530, 370, 530, 'stroke: red; stroke-width: 3;'));
$oLine->setMarker($oMarker32, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(120, 580, 370, 580, 'stroke: green; stroke-width: 3;'));
$oLine->setMarker($oMarker33, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(120, 630, 370, 630, 'stroke: cyan; stroke-width: 3;'));
$oLine->setMarker($oMarker34, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(120, 680, 370, 680, 'stroke: magenta; stroke-width: 3;'));
$oLine->setMarker($oMarker35, SVGMarker::MARKER_START | SVGMarker::MARKER_END);

$oSVG->add(new SVGText(585, 440, 'changed color/size', SVGText::STYLE_ALIGN_MIDDLE));
$oLine = $oSVG->add(new SVGLine(470, 480, 720, 480, 'stroke: blue; stroke-width: 3;'));
$oLine->setMarker($oMarker41, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(470, 530, 720, 530, 'stroke: red; stroke-width: 3;'));
$oLine->setMarker($oMarker42, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(470, 580, 720, 580, 'stroke: green; stroke-width: 3;'));
$oLine->setMarker($oMarker43, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(470, 630, 720, 630, 'stroke: cyan; stroke-width: 3;'));
$oLine->setMarker($oMarker44, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
$oLine = $oSVG->add(new SVGLine(470, 680, 720, 680, 'stroke: magenta; stroke-width: 3;'));
$oLine->setMarker($oMarker45, SVGMarker::MARKER_START | SVGMarker::MARKER_END);

$oSVG->output();