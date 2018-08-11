<?php

namespace App\Http\Controllers;

use App\User;

class nPlusOneQueryDetectorController extends Controller
{
    /**
     * Функция запускает запрос в цикле, тем самым порождает ошибку которую хэндлит пакет
     * https://github.com/beyondcode/laravel-query-detector
     */
    public function index()
    {
        $users = User::with('phone')->get();
        // Создание запроса N+1
        foreach ($users as $user) {
            dump($user = User::with('phone')->find($user->id));
        }
    }
}
