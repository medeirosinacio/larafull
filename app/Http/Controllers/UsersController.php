<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    private User $user;


    public function __construct(User $user)
    {
        $this->user = new $user;
    }


    public function list(): Renderable
    {
        return view('painel.users.list', ['users' => $this->user::all()]);
    }


    public function show(User $id): Renderable
    {
        return view('painel.users.show', ['user' => $user = $id]);
    }


    public function showStoreForm(): Renderable
    {
        return view('painel.users.create', ['user' => $this->user]);
    }


    public function store(Request $request): Response
    {
        $request->validate([
            'username' => 'required|unique:users|min:10|max:100',
            'first_name' => 'required|min:2|max:100',
            'last_name' => 'required|min:2|max:100',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $this->user->fill($request->all());

        $this->user->saveOrFail();

        return response()->success([
            'redirect' => $this->user->getUrl()
        ]);

    }

    public function showUpdateForm(User $id): Renderable
    {
        return view('painel.users.update', ['user' => $id]);
    }


    public function update(User $id, Request $request): Response
    {
        $this->user = $id;

        Validator::make($request->all(), [
            'username' => [
                'required',
                'min:10',
                'max:100',
                Rule::unique('users')->ignore($this->user->id)
            ],
            'first_name' => 'required|min:2|max:100',
            'last_name' => 'required|min:2|max:100',
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($this->user->id)],
        ])->validate();

        $this->user->fill($request->all());

        $this->user->saveOrFail();

        return response()->success([
            'redirect' => $this->user->getUrl()
        ]);

    }
}

