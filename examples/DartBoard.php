<?php

/**
 * This example uses a dartboard to demonstrate the advantages of using polar
 * coordinates when constructing objects based on circle calculations.
 *
 * In addition, the use of user-defined attributes is shown, for example to react
 * on user interactions.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */

declare(strict_types=1);

include '../autoloader.php';

use SKien\SVGCreator\SVG;
use SKien\SVGCreator\SVGElement;
use SKien\SVGCreator\SVGGroup;
use SKien\SVGCreator\Shapes\SVGEllipse;
use SKien\SVGCreator\Shapes\SVGPath;
use SKien\SVGCreator\Shapes\SVGRect;
use SKien\SVGCreator\Text\SVGText;

$iSVGWidth = 800;
$iSVGHeight = 600;

$oSVG = new SVG();
$oSVG->setPrettyOutput(true);
$oSVG->setSize($iSVGWidth, $iSVGHeight);

$oSVG->addStyleDef(".grid {stroke: #999; stroke-width: 1; stroke-dasharray: 1 2;}");
$oSVG->addStyleDef("text {fill: white; text-anchor: middle; dominant-baseline: middle; font-weight: 400; font-style: normal; font-family: 'Arial';}");
$oSVG->addStyleDef(".seg1 {fill: darkgreen; stroke: #fff; stroke-width: 2;}");
$oSVG->addStyleDef(".seg2 {fill: red; stroke: #fff; stroke-width: 2;}");
$oSVG->addStyleDef(".seg3 {fill: black; stroke: #fff; stroke-width: 2;}");
$oSVG->addStyleDef(".seg4 {fill: #F5DEB3; stroke: #fff; stroke-width: 2;}");
$oSVG->addStyleDef(".seg1:hover, .seg2:hover, .seg3:hover, .seg4:hover {fill: blue;}");

$oSVG->add(new SVGRect(0, 0, $iSVGWidth, $iSVGHeight, 'fill: black;'));

$aScore = [20, 1, 18, 4, 13, 6, 10, 15, 2, 17, 3, 19, 7, 16, 8, 11, 14, 9, 12, 5];

$radius = $iSVGWidth > $iSVGHeight ? $iSVGHeight / 2 : $iSVGWidth / 2;
$oBoard = new SVGGroup('board');
$degree = -99;      // starting point is -99 degrees (-90 degrees minus half segment angle)
$r = [0.05 * $radius, 0.1 * $radius, 0.39 * $radius, 0.45 * $radius, 0.74 * $radius, 0.8 * $radius, 0.9 * $radius];
for ($i = 0; $i < 20; $i++) {
    // Inner single-counting segments
    addHotSpot(createSegment($i % 2 == 0 ? 'seg3' : 'seg4', $degree, $r[1], $r[2]), $aScore[$i]);
    // Inner wreath containing the triple counting fields
    addHotSpot(createSegment($i % 2 == 0 ? 'seg2' : 'seg1', $degree, $r[2], $r[3]), 3 * $aScore[$i], 'Tripple ' . $aScore[$i], 'T' . $aScore[$i]);
    // Outer single-counting segments
    addHotSpot(createSegment($i % 2 == 0 ? 'seg3' : 'seg4', $degree, $r[3], $r[4]), $aScore[$i]);
    // Outer wreath containing the double counting fields
    addHotSpot(createSegment($i % 2 == 0 ? 'seg2' : 'seg1', $degree, $r[4], $r[5]), 2 * $aScore[$i], 'Double ' . $aScore[$i], 'D' . $aScore[$i]);

    // Score around the board
    $oText = $oBoard->add(new SVGText(0, -$r[6], (string) $aScore[$i]));
    $oText->setAttribute('font-size', 0.15 * $radius);
    $oText->rotate($degree + 99);

    $degree += 18; // (360 / 20)
}
addHotSpot(new SVGEllipse(0, 0, $r[1], $r[1], 'seg1'), 25, 'Bull', '25');
addHotSpot(new SVGEllipse(0, 0, $r[0], $r[0], 'seg2'), 50, 'Bulls Eye', '50');

$oBoard->translate($iSVGWidth / 2, $iSVGHeight / 2);
$oSVG->add($oBoard);

/**
 * Creates a subsegment with the specified values.
 * The subsegment is created from the inner to the outer radius, starting at the
 * specified angle in degrees and ending at the specified angle plus 18 (360 / 20).
 * The specified class is set for the display style.
 * @param string $strClass
 * @param float $degree
 * @param float $rInner
 * @param float $rOuter
 * @return SVGPath
 */
function createSegment(string $strClass, float $degree, float $rInner, float $rOuter) : SVGPath
{
    global $oSVG;

    [$x1, $y1] = $oSVG->fromPolar($rInner, $degree);
    [$x2, $y2] = $oSVG->fromPolar($rInner, $degree + 18);
    [$x3, $y3] = $oSVG->fromPolar($rOuter, $degree + 18);
    [$x4, $y4] = $oSVG->fromPolar($rOuter, $degree);

    $oPath = new SVGPath($strClass);
    $oPath->moveTo($x1, $y1);
    $oPath->arcAt($rInner, $rInner, 0, 0, 1, $x2, $y2);
    $oPath->lineTo($x3, $y3);
    $oPath->arcAt($rOuter, $rOuter, 0, 0, 0, $x4, $y4);

    return $oPath;
}

/**
 * Adds the element to the board and set the user defined data attributes that
 * can be evluated e.g. within a `click` eventhandler to display or process the
 * clicked score.
 * @param SVGElement $oHotSpot
 * @param int $iScore
 * @param string $strText
 * @param string $strShort
 */
function addHotSpot(SVGElement $oHotSpot, int $iScore, string $strText = null, string $strShort = null) : void
{
    global $oBoard;
    $oBoard->add($oHotSpot);
    $oHotSpot->setAttribute('data-score', $iScore);
    $oHotSpot->setAttribute('data-text', $strText ?? (string) $iScore);
    $oHotSpot->setAttribute('data-short', $strShort ?? (string) $iScore);
}
?>
<!DOCTYPE HTML>
<html lang="de-de">
<head>
<script>
function onLoad()
{
	var oBoard = document.getElementById('dartboard');
	oBoard.addEventListener('click', onBoardClicked);
}

function onBoardClicked(evt)
{
	var strMsg = "Dartboard clicked\n";
	if (evt.srcElement.getAttribute('data-score') !== null) {
		strMsg += 'Score: ' + evt.srcElement.getAttribute('data-score') + ' (' + evt.srcElement.getAttribute('data-text') + ')';
	} else {
		strMsg += 'Outside - no score :-(';
	}
	alert(strMsg);
}
</script>
</head>
<body onload="onLoad()">
<div id="dartboard">
	<?php echo $oSVG->getSVG(); ?>
</div>
</body>