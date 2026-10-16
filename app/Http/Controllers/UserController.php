<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Port;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ↓リンクエラーが起きていないかを真偽判定しています。
        if (!view()->exists('user.index')) {
            // ↓エラー画面
            return redirect()->route("users.error")->with('value', "1");
        }

        try {
            // ↓ログイン画面
            return view("user.index");
            // 原因不明エラーが起きた時
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("users.error")->with('value', "2");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ↓リンクエラーが起きていないかを真偽判定しています。
        if (!view()->exists('user.create')) {
            // ↓エラー画面
            return redirect()->route("users.error")->with('value', "1");
        }

        try {
            // ↓ユーザー登録画面
            return view("user.create");
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("users.error")->with('value', "2");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // ↓PWとPW確認の値が一緒なのかを真偽判定しています。
        if ($request->input("pw") == $request->input("pwasr")) {
            $users = User::All();

            foreach ($users as $user) {
                // ↓データベースのテーブルにnameと入力したがIDが一緒なのかを真偽判定しています。
                if ($request->input("id") == $user['name']) {
                    // ↓ユーザー登録画面
                    return redirect()->route("users.create")
                    ->with('usercreateerror', "すでにIDが使用されています。")
                    ->withInput();
                }
            }

            $name = $request->input("id");
            $pw = $request->input("pw");

            $user = new User();

            $user->name = $name;
            $user->password = $pw;
            $user->created_at = Carbon::now('Asia/Tokyo');

            // ユーザー登録ができたのかを真偽判定しています。
            if ($user->save()) {
                // ↓ログイン画面
                return view("user.index");
            } else {
                // ↓ユーザー登録画面
                return redirect()->route("users.create")
                ->with('usercreateerror', "ユーザー登録に失敗しました。")
                ->withInput();
            }
            
        } else {
            // ↓ユーザー登録画面
            return redirect()->route("users.create")
            ->with('usercreateerror', "PWとPW確認の値が一致しません。")
            ->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function error(UserRequest $request)
    {
        return view("user.error");
    }

    public function login(UserRequest $request)
    {
        // ↓値が入力されているのかを真偽判定しています。
        if ($request->filled('id') && $request->filled('pw')) {
            
            // ログイン処理
            $login = [
                'name' => $request->input('id'),
                'password' => $request->input('pw'),
            ];

            // ↓ログインができているのかを真偽判定しています。
            if (Auth::attempt($login)) {
                $ports = Port::all();
                $loginsession = "ようこそ、". $request->input('id');

                // ↓掲示板一覧画面
                return view("port.index", compact("ports", "loginsession"));
            } else {
                // ↓ログイン画面
                return redirect()->route("users.index")->with('userloginerror', "ログインに失敗しました。");
            }
        } else {
            // ↓ログイン画面
            return redirect()->route("users.index")->with('userloginerror', "値を正しく入力してください。");
        }
    }
}
