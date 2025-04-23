<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider, $type = 'employer')
    {
        try {
            $userSocial = Socialite::driver($provider)->stateless()->user();
            $users = $this->userRepository->all(['email' => $userSocial->getEmail()]);
            // dd($users);

            if ($users->count() > 0) {
                Auth::login($users->first());
                return redirect()->route('users.profile');
            } else {
                $full_name = $userSocial->getName();
                $first_name = explode(' ', $full_name)[0] ?? null;
                $last_name = explode(' ', $full_name)[1] ?? null;
                $user = [
                    'company_name' => $full_name,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'phone_number' => null,
                    'email' => $userSocial->getEmail(),
                    'provider_id' => $userSocial->getId(),
                    'provider' => $provider,
                ];
                // dd($user);
                return redirect()->route('front.register', ['type' => $type])->withInput($user);
            }
        } catch (Throwable $e) {
            return redirect()->route('front.register', ['type' => $type]);
        }
    }
}
