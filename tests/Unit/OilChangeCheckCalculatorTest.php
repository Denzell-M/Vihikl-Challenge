<?php

namespace Tests\Unit;

use App\Services\OilChangeCheckCalculator;
use Carbon\CarbonImmutable;
use Tests\TestCase;

class OilChangeCheckCalculatorTest extends TestCase
{
    public function test_it_does_not_require_an_oil_change_when_below_both_thresholds(): void
    {
        $calculator = new OilChangeCheckCalculator();
        $asOf = CarbonImmutable::parse("2026-05-05");
        $previousOilChangeDate = CarbonImmutable::parse("2026-01-05");

        $needsOilChange = $calculator->needsOilChange(
            currentOdometer: 14000,
            previousOilChangeDate: $previousOilChangeDate,
            previousOilChangeOdometer: 10000,
            asOf: $asOf,
        );

        $this->assertFalse($needsOilChange);
    }

    public function test_it_requires_an_oil_change_when_over_the_distance_threshold(): void
    {
        $calculator = new OilChangeCheckCalculator();
        $asOf = CarbonImmutable::parse("2026-05-05");
        $previousOilChangeDate = CarbonImmutable::parse("2026-01-05");

        $needsOilChange = $calculator->needsOilChange(
            currentOdometer: 15001,
            previousOilChangeDate: $previousOilChangeDate,
            previousOilChangeOdometer: 10000,
            asOf: $asOf,
        );

        $this->assertTrue($needsOilChange);
    }

    public function test_it_requires_an_oil_change_when_over_the_time_threshold(): void
    {
        $calculator = new OilChangeCheckCalculator();
        $asOf = CarbonImmutable::parse("2026-05-05");
        $previousOilChangeDate = CarbonImmutable::parse("2025-10-01");

        $needsOilChange = $calculator->needsOilChange(
            currentOdometer: 12000,
            previousOilChangeDate: $previousOilChangeDate,
            previousOilChangeOdometer: 10000,
            asOf: $asOf,
        );

        $this->assertTrue($needsOilChange);
    }
}
