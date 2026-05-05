<?php

namespace App\Http\Controllers;

use App\Models\OilChangeCheck;
use App\Services\OilChangeCheckCalculator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OilChangeCheckController extends Controller
{
    public function __construct(
        private readonly OilChangeCheckCalculator $calculator,
    ) {}

    public function create(): View
    {
        return view("oil-change-checks.create");
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            "current_odometer" => ["required", "integer", "min:0"],
            "previous_oil_change_date" => ["required", "date", "before:today"],
            "previous_oil_change_odometer" => [
                "required",
                "integer",
                "min:0",
                "lte:current_odometer",
            ],
        ]);

        $oilChangeCheck = new OilChangeCheck($validated);
        $oilChangeCheck->save();

        return redirect()->route("oil-change-checks.show", $oilChangeCheck);
    }

    public function show(OilChangeCheck $oilChangeCheck): View
    {
        return view("oil-change-checks.result", [
            "oilChangeCheck" => $oilChangeCheck,
            "needsOilChange" => $this->calculator->needsOilChange(
                currentOdometer: $oilChangeCheck->current_odometer,
                previousOilChangeDate: $oilChangeCheck->previous_oil_change_date,
                previousOilChangeOdometer: $oilChangeCheck->previous_oil_change_odometer,
            ),
        ]);
    }
}
