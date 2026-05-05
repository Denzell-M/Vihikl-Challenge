<?php

namespace App\Services;

use Carbon\CarbonInterface;

class OilChangeCheckCalculator
{
    public function needsOilChange(
        int $currentOdometer,
        CarbonInterface $previousOilChangeDate,
        int $previousOilChangeOdometer,
        ?CarbonInterface $asOf = null,
    ): bool {
        $asOf ??= now();

        $distanceDriven = $currentOdometer - $previousOilChangeOdometer;
        $sixMonthsAgo = $previousOilChangeDate->copy()->addMonthsNoOverflow(6);

        return $distanceDriven > 5000 || $asOf->greaterThan($sixMonthsAgo);
    }
}
