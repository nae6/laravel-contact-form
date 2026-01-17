<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Responses\LoginResponse as CustomLoginResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Http\Responses\LogoutResponse as CustomLogoutResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Http\Requests\LoginFormRequest;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FortifyLoginRequest::class, LoginFormRequest::class);

        $this->app->singleton(LogoutResponse::class, CustomLogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::registerView(function ()
        {
            return view('auth.register');
        });

        Fortify::loginView(function ()
        {
            return view('auth.login');
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        Fortify::authenticateUsing(function (FortifyLoginRequest $request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password))
                {
                    return $user;
                }

            throw ValidationException::withMessages
            ([
                'password' => 'ログイン情報が登録されていません',
            ]);
        });
    }
}
