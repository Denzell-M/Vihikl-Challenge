<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oil Change Check</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 720px;
            margin: 40px auto;
            padding: 0 16px;
            line-height: 1.5;
        }

        label {
            display: block;
            margin-top: 16px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            box-sizing: border-box;
        }

        .error {
            color: #b00020;
            margin-top: 6px;
        }

        .button {
            margin-top: 20px;
            padding: 10px 16px;
            border: 0;
            background: #111827;
            color: white;
            cursor: pointer;
        }

        .errors {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            padding: 12px 16px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Oil Change Check</h1>
    <p>Enter the vehicle details below to see whether an oil change is needed.</p>

    @if ($errors->any())
        <div class="errors">
            <strong>Please fix the following:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('oil-change-checks.store') }}">
        @csrf

        <label for="current_odometer">Current Odometer</label>
        <input
            id="current_odometer"
            name="current_odometer"
            type="number"
            min="0"
            value="{{ old('current_odometer') }}"
            placeholder="123456"
            required
        >
        @error('current_odometer')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="previous_oil_change_date">Date of Previous Oil Change</label>
        <input
            id="previous_oil_change_date"
            name="previous_oil_change_date"
            type="date"
            value="{{ old('previous_oil_change_date') }}"
            required
        >
        @error('previous_oil_change_date')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="previous_oil_change_odometer">Odometer at Previous Oil Change</label>
        <input
            id="previous_oil_change_odometer"
            name="previous_oil_change_odometer"
            type="number"
            min="0"
            value="{{ old('previous_oil_change_odometer') }}"
            placeholder="112345"
            required
        >
        @error('previous_oil_change_odometer')
            <div class="error">{{ $message }}</div>
        @enderror

        <button class="button" type="submit">Check Oil Change Status</button>
    </form>
</body>
</html>
