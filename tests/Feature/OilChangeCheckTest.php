<?php

namespace Tests\Feature;

use App\Models\OilChangeCheck;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OilChangeCheckTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        CarbonImmutable::setTestNow(CarbonImmutable::parse("2026-05-05"));
    }

    protected function tearDown(): void
    {
        CarbonImmutable::setTestNow();

        parent::tearDown();
    }

    public function test_the_form_page_loads(): void
    {
        $response = $this->get("/");

        $response->assertOk();
        $response->assertSee("Oil Change Check");
    }

    public function test_it_stores_a_valid_oil_change_check_and_redirects_to_the_result_page(): void
    {
        $response = $this->post("/check", [
            "current_odometer" => 16000,
            "previous_oil_change_date" => "2025-10-01",
            "previous_oil_change_odometer" => 10000,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseCount("oil_change_checks", 1);

        $oilChangeCheck = OilChangeCheck::query()->firstOrFail();

        $response->assertRedirect(
            route("oil-change-checks.show", $oilChangeCheck),
        );
    }

    public function test_it_shows_validation_errors_for_invalid_submission(): void
    {
        $response = $this->post("/check", [
            "current_odometer" => 9000,
            "previous_oil_change_date" => "2026-05-05",
            "previous_oil_change_odometer" => 10000,
        ]);

        $response->assertSessionHasErrors([
            "previous_oil_change_date",
            "previous_oil_change_odometer",
        ]);

        $this->assertDatabaseCount("oil_change_checks", 0);
    }

    public function test_the_result_page_shows_when_an_oil_change_is_needed(): void
    {
        $oilChangeCheck = OilChangeCheck::query()->create([
            "current_odometer" => 16001,
            "previous_oil_change_date" => "2025-10-01",
            "previous_oil_change_odometer" => 10000,
        ]);

        $response = $this->get(
            route("oil-change-checks.show", $oilChangeCheck),
        );

        $response->assertOk();
        $response->assertSee("This car needs an oil change.");
        $response->assertSee("16001");
        $response->assertSee("2025-10-01");
        $response->assertSee("10000");
    }

    public function test_the_result_page_shows_when_an_oil_change_is_not_needed(): void
    {
        $oilChangeCheck = OilChangeCheck::query()->create([
            "current_odometer" => 14000,
            "previous_oil_change_date" => "2026-01-05",
            "previous_oil_change_odometer" => 10000,
        ]);

        $response = $this->get(
            route("oil-change-checks.show", $oilChangeCheck),
        );

        $response->assertOk();
        $response->assertSee("This car does not need an oil change.");
    }
}
