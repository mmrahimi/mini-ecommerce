<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $guestCart = Cart::where('session_id', session()->getId())
            ->whereNull('user_id')
            ->first();

        $request->authenticate();
        $request->session()->regenerate();

        $user = auth()->user();

        $userCart = Cart::firstOrCreate(
            ['user_id' => $user->id],
            ['session_id' => session()->getId()]
        );

        if ($guestCart) {
            $userCart->products()->syncWithoutDetaching(
                $guestCart->products->pluck('id')->toArray()
            );

            $guestCart->delete();
        }

        $userCart->update([
            'session_id' => session()->getId(),
        ]);

        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
