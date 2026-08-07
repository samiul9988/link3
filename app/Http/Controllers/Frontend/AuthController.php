<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Helpers\CartHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('customer')->check()) return redirect()->route('home');
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate(['email' => 'required|string', 'password' => 'required']);
        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $credentials = [$field => $request->email, 'password' => $request->password];
        
        if (Auth::guard('customer')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            CartHelper::mergeOnLogin(Auth::guard('customer')->id());
            return redirect()->intended(route('home'));
        }
        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function showRegister() { return view('frontend.auth.register'); }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|unique:customers,phone',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        Auth::guard('customer')->login($customer);
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function showForgot() { return view('frontend.auth.forgot-password'); }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::broker('customers')->sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT ? back()->with('success', __($status)) : back()->withErrors(['email' => __($status)]);
    }

    public function showReset($token)
    {
        return view('frontend.auth.reset-password', ['token' => $token, 'email' => request('email')]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate(['token' => 'required', 'email' => 'required|email', 'password' => 'required|string|min:6|confirmed']);
        $status = Password::broker('customers')->reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($customer, $password) {
            $customer->forceFill(['password' => Hash::make($password)])->save();
            Auth::guard('customer')->login($customer);
        });
        return $status === Password::PASSWORD_RESET ? redirect()->route('home')->with('success', __($status)) : back()->withErrors(['email' => [__($status)]]);
    }

    public function redirectToGoogle() { return Socialite::driver('google')->redirect(); }
    public function handleGoogleCallback() {
        $googleUser = Socialite::driver('google')->user();
        $customer = Customer::updateOrCreate(['email' => $googleUser->email], ['name' => $googleUser->name, 'provider' => 'google', 'provider_id' => $googleUser->id, 'password' => Hash::make(uniqid())]);
        Auth::guard('customer')->login($customer);
        return redirect()->route('home');
    }
    public function redirectToFacebook() { return Socialite::driver('facebook')->redirect(); }
    public function handleFacebookCallback() {
        $fbUser = Socialite::driver('facebook')->user();
        $customer = Customer::updateOrCreate(['email' => $fbUser->email], ['name' => $fbUser->name, 'provider' => 'facebook', 'provider_id' => $fbUser->id, 'password' => Hash::make(uniqid())]);
        Auth::guard('customer')->login($customer);
        return redirect()->route('home');
    }
}
