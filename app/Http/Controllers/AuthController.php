<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectAfterLogin();
        }

        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Las credenciales no son correctas.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return $this->redirectAfterLogin();
    }

    public function showRegister(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectAfterLogin();
        }

        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        Client::create([
            'id_user' => $user->id,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('account')->with('success', '¡Bienvenido a EcoEntrega! Tu cuenta fue creada correctamente.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function account(Request $request): View|RedirectResponse
    {
        if ($request->user()->role === 'admin') {
            return redirect('/admin');
        }

        $user = $request->user()->loadCount(['products', 'orders']);
        $cartProducts = $user->shoppingCart?->cartDetails()->count() ?? 0;
        $featuredProducts = Product::query()->with('category')->latest('publication_date')->take(4)->get();

        return view('account', compact('user', 'cartProducts', 'featuredProducts'));
    }

    public function addToCart(Request $request, Product $product): RedirectResponse
    {
        $cart = ShoppingCart::firstOrCreate(
            ['id_user' => $request->user()->id],
            ['creation_date' => now()]
        );

        $detail = $cart->cartDetails()->firstOrNew(['id_product' => $product->id_product]);
        $detail->quantity = ($detail->quantity ?? 0) + 1;
        $detail->subtotal = $product->price * $detail->quantity;
        $detail->save();

        return back()->with('success', 'Producto agregado al carrito.');
    }

    public function cart(Request $request): View|RedirectResponse
    {
        if ($request->user()->role === 'admin') {
            return redirect('/admin');
        }

        $cart = $request->user()->shoppingCart()->with('cartDetails.product')->first();
        $details = $cart?->cartDetails ?? collect();
        $total = $details->sum('subtotal');

        return view('cart', compact('details', 'total'));
    }

    public function removeFromCart(Request $request, int $detail): RedirectResponse
    {
        $cart = $request->user()->shoppingCart;
        abort_unless($cart, 404);
        $cart->cartDetails()->whereKey($detail)->firstOrFail()->delete();

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    private function redirectAfterLogin(): RedirectResponse
    {
        return Auth::user()->role === 'admin'
            ? redirect('/admin')
            : redirect()->route('account');
    }
}
