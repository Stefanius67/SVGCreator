<?php

declare(strict_types=1);

namespace Tests\SKien;

/**
 *
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
trait TestCaseAccessHelperTrait
{
    private function getObjectProperty($object, $strName)
    {
        $reflectedClass = new \ReflectionClass($object);
        $reflection = $reflectedClass->getProperty($strName);
        $reflection->setAccessible(true);

        return $reflection->getValue($object);
    }
}