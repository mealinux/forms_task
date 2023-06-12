<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Services\TokenService;

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
      $request->authenticate();

      $request->session()->regenerate();

      if (!auth()->user()->formsToken?->token) {
         $tokenService = new TokenService();

         return $tokenService->redirectToGoogle();
      }

      return redirect(RouteServiceProvider::HOME);
   }

   /**
    * Destroy an authenticated session.
    */
   public function destroy(Request $request): RedirectResponse
   {
      Auth::guard('web')->logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect(RouteServiceProvider::HOME);
   }
}
