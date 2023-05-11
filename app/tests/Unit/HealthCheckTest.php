<?php
declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HealthCheckTest extends TestCase
{
    public function testCheck(): void
    {
        self::assertSame(1,1);
    }


}