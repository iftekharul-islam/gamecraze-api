<?php

namespace App\Services;

class UserLogoutService {
    public function logout() {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return;
    }
}
