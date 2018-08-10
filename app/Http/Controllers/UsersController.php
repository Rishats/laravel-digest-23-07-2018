<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('phone')
            ->get();

        return $users->toJson();
    }

    /**
     * Display a listing of the resource which Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function onlyTrashed()
    {
        $users = User::onlyTrashed()
            ->with('phone')
            ->get();

        return $users->toJson();
    }

    /**
     * Display a listing of the resource with Trashed.
     *
     * @return \Illuminate\Http\Response
     */
    public function withTrashed()
    {
        $users = User::withTrashed()
            ->with('phone')
            ->get();

        return $users->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show user
     *
     * @param User $user
     * @return User|bool|mixed|null
     * @throws \Exception
     */
    public function show(User $user)
    {
        $user = $user->with('phone')
            ->firstOrFail()
            ->toJson();

        return $user;
    }

    /**
     * Show trashed user.
     *
     * @param User $user
     * @return User|bool|mixed|null
     * @throws \Exception
     */
    public function showTrashed(User $user)
    {
        $user = $user->onlyTrashed()->with('phone')
            ->firstOrFail()
            ->toJson();

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    public function restoreTrashed(User $user)
    {
        $user = $user->onlyTrashed()->with('phone')
            ->firstOrFail();
        $user->restore();
        $user->phone()->restore();

        return response(['restoreTrashed' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     * Работаем с пакетом https://github.com/michaeldyrynda/laravel-cascade-soft-deletes
     * User модель юзает сascade soft deletes.
     *
     * @param User $user
     * @return User|bool|mixed|null
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user = $user->with('phone')
            ->find($user->id)
            ->delete();

        return response(['destroy' => $user]);
    }

    /**
     * Remove the specified resource from db.
     * Работаем с пакетом https://github.com/michaeldyrynda/laravel-cascade-soft-deletes
     * User модель юзает сascade soft deletes.
     *
     * @param int $id
     * @return User|bool|mixed|null
     * @throws \Exception
     */
    public function destroyPermanently($id)
    {
        $user = User::withTrashed()->findOrFail($id)->forceDelete();

        return response(['destroyPermanently' => $user]);
    }
}
