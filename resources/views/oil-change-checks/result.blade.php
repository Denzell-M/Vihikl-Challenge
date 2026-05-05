<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oil Change Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 720px;
            margin: 40px auto;
            padding: 0 16px;
            line-height: 1.5;
        }

        .card {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 20px;
            background: #f9fafb;
        }

        .status {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 16px;
        }

        .needs {
            color: #b91c1c;
        }

        .does-not-need {
            color: #166534;
        }

        .row {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #1d4ed8;
        }
    </style>
</head>
<body>
    <h1>Oil Change Result</h1>

    <div class="card">
        <div class="status {{ $needsOilChange ? 'needs' : 'does-not-need' }}">
            {{ $needsOilChange ? 'This car needs an oil change.' : 'This car does not need an oil change.' }}
        </div>

        <div class="row">
            <span class="label">Current Odometer:</span>
            <span>{{ $oilChangeCheck->current_odometer }}</span>
        </div>

        <div class="row">
            <span class="label">Previous Oil Change Date:</span>
            <span>{{ $oilChangeCheck->previous_oil_change_date->format('Y-m-d') }}</span>
        </div>

        <div class="row">
            <span class="label">Odometer at Previous Oil Change:</span>
            <span>{{ $oilChangeCheck->previous_oil_change_odometer }}</span>
        </div>
    </div>

    <a href="{{ route('oil-change-checks.create') }}">← Check another car</a>
</body>
</html>
