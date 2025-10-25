<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h1>Welcome, {{ Auth::user()->name }}</h1>
    @if ($slambook)
    <div style="border: 1px solid #ddd; padding: 20px; margin: 20px 0; border-radius: 8px; background-color: #f9f9f9;">
        <h3>Your Slambook</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold; width: 30%;">Name:</td>
                <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ Auth::user()->name }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Age:</td>
                <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $slambook->age }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Zodiac Sign:</td>
                <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $slambook->zodiac_sign }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">In a Relationship:</td>
                <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $slambook->in_relationship ? 'Yes' : 'No' }}
                </td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Dream Job:</td>
                <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $slambook->dream_job }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Motto in Life:</td>
                <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $slambook->motto }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; font-weight: bold;">Describe Yourself in 3 Words:</td>
                <td style="padding: 8px;">{{ $slambook->three_words }}</td>
            </tr>
        </table>
        <p style="margin-top: 15px; font-size: 12px; color: #666;">
            Submitted on: {{ $slambook->created_at->format('F j, Y \a\t g:i A') }}
        </p>
    </div>
    @endif

    <div style="margin: 20px 0;">
        @if ($slambook)
        <a href="{{ route('slambook.edit', $slambook->id) }}"
            style="background-color: #ffdd00; color: black; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Edit Slambook
        </a>
        <form method="POST" action="{{ route('slambook.destroy', $slambook->id) }}" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to reset slambook?');"
                style="background-color: #ff0040; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-left: 10px;">
                Reset Slambook
            </button>
        </form>
        @else
        <a href="{{ route('slambook.start') }}"
            style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Start Slambook
        </a>
        @endif
    </div>

    <form method="POST" action="{{ route('auth.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <p>You are logged in!</p>
</body>

</html>