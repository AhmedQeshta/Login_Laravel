<?php

namespace App\Services;

use App\SocialFacebookAccount;
use App\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialFacebookAccountService{
    public function createOrGetUser(ProviderUser $providerUser){
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();
        if ($account) {
            return $account->user;
        } else {
            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);
            $user = User::whereEmail($providerUser->getEmail())->first();
            if (!$user) {
                $G_phone = '059'.rand(2,9).rand(000000,999999);
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' =>  Hash::make(rand(10,11)),
                    'phone' => $G_phone,
//                    'phone' => $providerUser->getAvatar(),

                ]);
            }
            $account->user()->associate($user);
            $account->save();
            return $user;
        }
    }
}
