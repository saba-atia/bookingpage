<div style="max-width: 400px; margin: 50px auto; padding: 20px; background-color: white; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); text-align: center;">
    <div style="margin-bottom: 16px; font-size: 14px; color: red;">
        {{ __('Thanks for signing up! Please verify your email by clicking the link we sent.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div style="margin-bottom: 16px; font-size: 14px; color: green; background-color: #f0fff4; padding: 10px; border-radius: 5px;">
            {{ __('A new verification link has been sent to your email.') }}
        </div>
    @endif

    <div style="margin-top: 16px; display: flex; justify-content: space-between; align-items: center;">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button style="background-color: red; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="color: red; text-decoration: underline; background: none; border: none; cursor: pointer; font-size: 14px;">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</div>
