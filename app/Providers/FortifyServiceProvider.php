<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                if($request->is('admin/login')) {

                    return redirect('/admin');
                }

                return redirect()->route('home');
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::registerView(function (Request $request) {

            if($request->is('register/')) {

                abort(404);
            }

            if($request->user() || $request->is('candidate/*') && $request->is('employee/*')) {

                return redirect()->route('login');
            }

            if($request->is('employee/register')) {

                return view('user.auth.employee_register');
            } elseif ($request->is('candidate/register')) {

                return view('user.auth.candidate_register');
            }

        });

        Fortify::authenticateUsing(function (Request $request) {

            if($request->is('admin/login')) {

                $user = User::where('email', $request->email)
                    ->where('type', 'admin')
                    ->first();

                return $user;
            } elseif($request->is('login')) {

                $user = User::where('email', $request->email)
                    ->where('type', '<>', 'admin')
                    ->first();

                return $user;
            }


        });


        Fortify::loginView(function (Request $request) {

            if($request->is('admin/login') && !Auth::check()) {

                return view('admin.auth.login');
            } elseif ($request->is('admin/login') && Auth::check()) {

                return redirect('admin/');
            }

            return view('user.auth.login');
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

    }
}
