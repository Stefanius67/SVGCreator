<?php

declare(strict_types=1);

namespace SKien\SVGCreator\ExtShapes;

use SKien\SVGCreator\Shapes\SVGPath;

/**
 * This class creates SVGPath displaying blockarrows of several types.
 *
 * In contrast to many graphics programs, where the width and length of the
 * arrowhead changes with the size and/or length of the arrow to be displayed, in
 * this implementation the dimensions of the arrowhead are explicitly defined.
 * The definition can be used for multiple arrows to ensure a uniform representation,
 * e.g. in diagrams.
 *
 * @SKienImage SVGBlockArrow.png
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGBlockArrow extends SVGPath
{
    /** Draws a block arrow with a single pike at the endpoint (x2,y2)     */
    public const SINGLE = 0;
    /** Draws a block arrow with a pike at start and endpoint       */
    public const DOUBLE = 1;
    /** Draws a right-angled block arrow with a pike at the vertical endpoint (x2,y2)     */
    public const ANGLED_VERT = 2;
    /** Draws a right-angled block arrow with a pike at the horizontal endpoint (x2,y2)     */
    public const ANGLED_HORZ = 3;
    /** Draws a right-angled block arrow with a pike at start and endpoint     */
    public const ANGLED_DOUBLE = 4;
    /** Draws a round-angled block arrow with a pike at the vertical endpoint (x2,y2)     */
    public const ROUNDED_VERT = 5;
    /** Draws a round-angled block arrow with a pike at the horizontal endpoint (x2,y2)     */
    public const ROUNDED_HORZ = 6;
    /** Draws a round-angled block arrow with a pike at start and endpoint     */
    public const ROUNDED_DOUBLE = 7;

    /** @var float  x-position of the startpoint     */
    protected float $x1;
    /** @var float  y-position of the startpoint     */
    protected float $y1;
    /** @var float  x-position of the endpoint     */
    protected float $x2;
    /** @var float  y-position of the endpoint     */
    protected float $y2;
    /** @var float  the calculated length     */
    protected float $length;
    /** @var SVGBlockArrowDef   the definition with the dimensions of the arrow and pike     */
    protected SVGBlockArrowDef $oDef;

    public function __construct(float $x1, float $y1, float $x2, float $y2, SVGBlockArrowDef $oDef, int $iType = self::SINGLE)
    {
        $this->x1 = $x1;
        $this->y1 = $y1;
        $this->x2 = $x2;
        $this->y2 = $y2;
        $this->oDef = $oDef;

        // calc the overall length
        $this->length = sqrt(($x2 - $x1) ** 2 + ($y2 - $y1) ** 2);

        parent::__construct($oDef->getStyle());
        switch ($iType) {
            case self::SINGLE:
                $this->buildSingle();
                break;
            case self::DOUBLE:
                $this->buildDouble();
                break;
            case self::ANGLED_VERT:
                $this->buildAngledVert();
                break;
            case self::ANGLED_HORZ:
                $this->buildAngledHorz();
                break;
            case self::ANGLED_DOUBLE:
                $this->buildAngledDouble();
                break;
            case self::ROUNDED_VERT:
                $this->buildRoundedVert();
                break;
            case self::ROUNDED_HORZ:
                $this->buildRoundedHorz();
                break;
            case self::ROUNDED_DOUBLE:
                $this->buildRoundedDouble();
                break;
        }
    }

    protected function buildSingle() : void
    {
        if ($this->length >= $this->oDef->pikeLength) {
            // the arrow first is drawn horizontally from the origin 0,0 in the calculated
            // length, then transformed to the desired position by translating to x1,y1 and
            // finally rotated so that it points to x2,y2
            $this->moveTo(0, 0);
            $this->lineTo(0, $this->oDef->width / 2);
            $this->lineTo($this->length - $this->oDef->pikeLength, $this->oDef->width / 2);
            $this->lineTo($this->length - $this->oDef->pikeLength, $this->oDef->pikeWidth / 2);
            $this->lineTo($this->length,  0);
            $this->lineTo($this->length - $this->oDef->pikeLength, -$this->oDef->pikeWidth / 2);
            $this->lineTo($this->length - $this->oDef->pikeLength, -$this->oDef->width / 2);
            $this->lineTo(0, -$this->oDef->width / 2);
            $this->close();

            $this->adjust();
        }
    }

    protected function buildDouble() : void
    {
        if ($this->length >= 2 * $this->oDef->pikeLength) {
            $this->moveTo(0, 0);
            $this->lineTo($this->oDef->pikeLength, $this->oDef->pikeWidth / 2);
            $this->lineTo($this->oDef->pikeLength, $this->oDef->width / 2);
            $this->lineTo($this->length - $this->oDef->pikeLength, $this->oDef->width / 2);
            $this->lineTo($this->length - $this->oDef->pikeLength, $this->oDef->pikeWidth / 2);
            $this->lineTo($this->length,  0);
            $this->lineTo($this->length - $this->oDef->pikeLength, -$this->oDef->pikeWidth / 2);
            $this->lineTo($this->length - $this->oDef->pikeLength, -$this->oDef->width / 2);
            $this->lineTo($this->oDef->pikeLength, -$this->oDef->width / 2);
            $this->lineTo($this->oDef->pikeLength, -$this->oDef->pikeWidth / 2);
            $this->close();

            $this->adjust();
        }
    }

    protected function adjust() : void
    {
        if ($this->length > 0) {
            // move origin to startpoint
            $this->translate($this->x1, $this->y1);

            // First calculate the number of degrees the arrow should be rotated...
            $degree = rad2deg(asin(abs($this->y2 - $this->y1) / $this->length));

            // ... and adjust it depending on the quarter to which the vector points to:
            //
            //   Q3 (180 ... 270°):   |  Q4 (270 ... 360°/ -90 ... 0°):
            //   x1 > x2              |  x1 < x2
            //   y1 > y2              |  y1 > y2
            //   => deg = 180 + deg   |  => deg = -deg
            //                        |
            //   ---------------------|-------------------------------- x
            //                        |
            //   Q2 (90 ... 180°):    |  Q1: (0 ... 90°):
            //   x1 > x2              |  x1 < x2
            //   y1 < y2              |  y1 < y2
            //   => deg = 180 - deg   |
            //
            if ($this->y1 > $this->y2) {
                // Q3, Q4
                $degree = -$degree;
            }
            if ($this->x1 > $this->x2) {
                // Q2, Q3
                $degree = 180 - $degree;
            }
            $this->rotate($degree);
        }
    }

    protected function buildAngledVert() : void
    {
        if ($this->length >= $this->oDef->pikeLength) {
            $mx = $this->x1 > $this->x2 ? -1 : 1;
            $my = $this->y1 > $this->y2 ? -1 : 1;

            $dx = $this->x2 - $this->x1;
            $dy = $this->y2 - $this->y1;

            $this->moveTo(0, 0);
            $this->lineTo(0,                                        $my * $this->oDef->width / 2);
            $this->lineTo($dx - ($mx * $this->oDef->width / 2),     $my * $this->oDef->width / 2);
            $this->lineTo($dx - ($mx * $this->oDef->width / 2),     $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx - ($mx * $this->oDef->pikeWidth / 2), $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx,                                      $dy);
            $this->lineTo($dx + ($mx * $this->oDef->pikeWidth / 2), $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx + ($mx * $this->oDef->width / 2),     $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx + ($mx * $this->oDef->width / 2),     $my * -$this->oDef->width / 2);
            $this->lineTo(0,                                        $my * -$this->oDef->width / 2);
            $this->close();

            $this->translate($this->x1, $this->y1);
        }
    }

    protected function buildAngledHorz() : void
    {
        if ($this->length >= $this->oDef->pikeLength) {
            $mx = $this->x1 > $this->x2 ? -1 : 1;
            $my = $this->y1 > $this->y2 ? -1 : 1;

            $dx = $this->x2 - $this->x1;
            $dy = $this->y2 - $this->y1;

            $this->moveTo(0, 0);
            $this->lineTo($mx * $this->oDef->width / 2,           0);
            $this->lineTo($mx * $this->oDef->width / 2,           $dy - ($my * $this->oDef->width / 2));
            $this->lineTo($dx - ($mx * $this->oDef->pikeLength),  $dy - ($my * $this->oDef->width / 2));
            $this->lineTo($dx - ($mx * $this->oDef->pikeLength),  $dy - ($my * $this->oDef->pikeWidth / 2));
            $this->lineTo($dx,                                    $dy);
            $this->lineTo($dx - ($mx * $this->oDef->pikeLength),  $dy + ($my * $this->oDef->pikeWidth / 2));
            $this->lineTo($dx - ($mx * $this->oDef->pikeLength),  $dy + ($my * $this->oDef->width / 2));
            $this->lineTo($mx * -$this->oDef->width / 2,          $dy + ($my * $this->oDef->width / 2));
            $this->lineTo($mx * -$this->oDef->width / 2,          0);
            $this->close();

            $this->translate($this->x1, $this->y1);
        }
    }

    protected function buildAngledDouble() : void
    {
        if ($this->length >= $this->oDef->pikeLength) {
            $mx = $this->x1 > $this->x2 ? -1 : 1;
            $my = $this->y1 > $this->y2 ? -1 : 1;

            $dx = $this->x2 - $this->x1;
            $dy = $this->y2 - $this->y1;

            $this->moveTo(0, 0);
            $this->lineTo($mx * $this->oDef->pikeLength,            $my * $this->oDef->pikeWidth / 2);
            $this->lineTo($mx * $this->oDef->pikeLength,            $my * $this->oDef->width / 2);
            $this->lineTo($dx - ($mx * $this->oDef->width / 2),     $my * $this->oDef->width / 2);
            $this->lineTo($dx - ($mx * $this->oDef->width / 2),     $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx - ($mx * $this->oDef->pikeWidth / 2), $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx,                                      $dy);
            $this->lineTo($dx + ($mx * $this->oDef->pikeWidth / 2), $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx + ($mx * $this->oDef->width / 2),     $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx + ($mx * $this->oDef->width / 2),     $my * -$this->oDef->width / 2);
            $this->lineTo($mx * $this->oDef->pikeLength,            $my * -$this->oDef->width / 2);
            $this->lineTo($mx * $this->oDef->pikeLength,            $my * -$this->oDef->pikeWidth / 2);
            $this->close();

            $this->translate($this->x1, $this->y1);
        }
    }

    protected function buildRoundedVert() : void
    {
        if ($this->length >= $this->oDef->pikeLength) {
            $mx = $this->x1 > $this->x2 ? -1 : 1;
            $my = $this->y1 > $this->y2 ? -1 : 1;

            $dx = $this->x2 - $this->x1;
            $dy = $this->y2 - $this->y1;

            if (abs($dy) - $this->oDef->pikeLength < abs($dx)) {
                $ly = 0;
                $lx = abs($dx) - (abs($dy) - $this->oDef->pikeLength);
                $ri = abs($dy) - $this->oDef->pikeLength - $this->oDef->width / 2;
                $ro = abs($dy) - $this->oDef->pikeLength + $this->oDef->width / 2;
            } else {
                $ly = abs($dy) - abs($dx) - $this->oDef->pikeLength;
                $lx = 0;
                $ri = abs($dx) - $this->oDef->width / 2;
                $ro = abs($dx) + $this->oDef->width / 2;
            }

            $this->moveTo(0, 0);
            $this->lineTo(0,        $my * $this->oDef->width / 2);
            if ($lx > 0) {
                $this->lineTo($mx * $lx,  $my * $this->oDef->width / 2);
            }
            $this->arcAt($ri, $ri, 0, 0, ($mx * $my < 0 ? 0 : 1), $mx * ($lx + $ri), $my * ($this->oDef->width / 2 + $ri));
            $this->lineTo($dx - ($mx * $this->oDef->width / 2),     $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx - ($mx * $this->oDef->pikeWidth / 2), $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx,                                      $dy);
            $this->lineTo($dx + ($mx * $this->oDef->pikeWidth / 2), $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx + ($mx * $this->oDef->width / 2),     $dy - ($my * $this->oDef->pikeLength));
            if ($ly > 0) {
                $this->lineTo($dx + ($mx * $this->oDef->width / 2), $dy - $my * ($this->oDef->pikeLength + $ly));
            }
            $this->arcAt($ro, $ro, 0, 0, ($mx * $my < 0 ? 1 : 0), $mx * $lx, $my * -$this->oDef->width / 2);
            if ($lx > 0) {
                $this->lineTo(0, $my * -$this->oDef->width / 2);
            }
            $this->close();

            $this->translate($this->x1, $this->y1);
        }
    }

    protected function buildRoundedHorz() : void
    {
        if ($this->length >= $this->oDef->pikeLength) {
            $mx = $this->x1 > $this->x2 ? -1 : 1;
            $my = $this->y1 > $this->y2 ? -1 : 1;

            $dx = $this->x2 - $this->x1;
            $dy = $this->y2 - $this->y1;

            if (abs($dx) - $this->oDef->pikeLength < abs($dy)) {
                $lx = 0;
                $ly = abs($dy) - (abs($dx) - $this->oDef->pikeLength);
                $ri = abs($dx) - $this->oDef->pikeLength - $this->oDef->width / 2;
                $ro = abs($dx) - $this->oDef->pikeLength + $this->oDef->width / 2;
            } else {
                $lx = abs($dx) - abs($dy) - $this->oDef->pikeLength;
                $ly = 0;
                $ri = abs($dy) - $this->oDef->width / 2;
                $ro = abs($dy) + $this->oDef->width / 2;
            }

            $this->moveTo(0, 0);
            $this->lineTo($mx * $this->oDef->width / 2,           0);
            if ($ly > 0) {
                $this->lineTo($mx * $this->oDef->width / 2,           $my * $ly);
            }
            $this->arcAt($ri, $ri, 0, 0, ($mx * $my < 0 ? 1 : 0), $mx * ($this->oDef->width / 2 + $ri), $my * ($ly + $ri));
            $this->lineTo($dx - ($mx * $this->oDef->pikeLength),  $dy - ($my * $this->oDef->width / 2));
            $this->lineTo($dx - ($mx * $this->oDef->pikeLength),  $dy - ($my * $this->oDef->pikeWidth / 2));
            $this->lineTo($dx,                                    $dy);
            $this->lineTo($dx - ($mx * $this->oDef->pikeLength),  $dy + ($my * $this->oDef->pikeWidth / 2));
            $this->lineTo($dx - ($mx * $this->oDef->pikeLength),  $dy + ($my * $this->oDef->width / 2));
            if ($lx > 0) {
                $this->lineTo($dx - $mx * ($this->oDef->pikeLength + $lx),  $dy + ($my * $this->oDef->width / 2));
            }
            $this->arcAt($ro, $ro, 0, 0, ($mx * $my < 0 ? 0 : 1), $mx * -$this->oDef->width / 2, $my * $ly);
            if ($ly > 0) {
                $this->lineTo($mx * -$this->oDef->width / 2, 0);
            }
            $this->close();

            $this->translate($this->x1, $this->y1);
        }
    }

    protected function buildRoundedDouble() : void
    {
        if ($this->length >= $this->oDef->pikeLength) {
            $mx = $this->x1 > $this->x2 ? -1 : 1;
            $my = $this->y1 > $this->y2 ? -1 : 1;

            $dx = $this->x2 - $this->x1;
            $dy = $this->y2 - $this->y1;

            if (abs($dx) < abs($dy)) {
                $lx = 0;
                $ly = abs($dy) - abs($dx);
                $ri = abs($dx) - $this->oDef->pikeLength - $this->oDef->width / 2;
                $ro = abs($dx) - $this->oDef->pikeLength + $this->oDef->width / 2;
            } else {
                $lx = abs($dx) - abs($dy);
                $ly = 0;
                $ri = abs($dy) - $this->oDef->pikeLength - $this->oDef->width / 2;
                $ro = abs($dy) - $this->oDef->pikeLength + $this->oDef->width / 2;
            }

            $this->moveTo(0, 0);
            $this->lineTo($mx * $this->oDef->pikeLength,            $my * $this->oDef->pikeWidth / 2);
            $this->lineTo($mx * $this->oDef->pikeLength,            $my * $this->oDef->width / 2);
            if ($lx > 0) {
                $this->lineTo($mx * ($lx + $this->oDef->pikeLength),  $my * $this->oDef->width / 2);
            }
            $this->arcAt($ri, $ri, 0, 0, ($mx * $my < 0 ? 0 : 1), $mx * ($lx + $ri + $this->oDef->pikeLength), $my * ($this->oDef->width / 2 + $ri));
            $this->lineTo($dx - ($mx * $this->oDef->width / 2),     $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx - ($mx * $this->oDef->pikeWidth / 2), $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx,                                      $dy);
            $this->lineTo($dx + ($mx * $this->oDef->pikeWidth / 2), $dy - ($my * $this->oDef->pikeLength));
            $this->lineTo($dx + ($mx * $this->oDef->width / 2),     $dy - ($my * $this->oDef->pikeLength));
            if ($ly > 0) {
                $this->lineTo($dx + ($mx * $this->oDef->width / 2), $dy - $my * ($this->oDef->pikeLength + $ly));
            }
            $this->arcAt($ro, $ro, 0, 0, ($mx * $my < 0 ? 1 : 0), $mx * ($lx + $this->oDef->pikeLength), $my * -$this->oDef->width / 2);
            if ($lx > 0) {
                $this->lineTo($mx * $this->oDef->pikeLength, $my * -$this->oDef->width / 2);
            }
            $this->lineTo($mx * $this->oDef->pikeLength,            $my * -$this->oDef->width / 2);
            $this->lineTo($mx * $this->oDef->pikeLength,            $my * -$this->oDef->pikeWidth / 2);
            $this->close();

            $this->translate($this->x1, $this->y1);
        }
    }
}