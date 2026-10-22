<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PortRequest;
use App\Models\User;
use App\Models\Port;
use App\Models\Portitem;
use App\Models\Portitemimg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Exception;

class PortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ↓リンクエラーが起きていないかを真偽判定しています。
        if (!view()->exists('port.index')) {
            // ↓エラー画面
            return redirect()->route("ports.error")->with('value', "1");
        }

        try {
            $ports = Port::all();

            // ↓ポートフォリオ一覧画面
            return view("port.index", compact("ports"));
            // 原因不明エラーが起きた時
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("ports.error")->with('value', "2");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ポートフォリオ閲覧処理

        // ↓リンクエラーが起きていないかを真偽判定しています。
        if (!view()->exists('port.show')) {
            // ↓エラー画面
            return redirect()->route("ports.error")->with('value', "1");
        }

        try {
            $port = Port::findOrFail($id);
            $portitems = Portitem::all();
            $portitemimgs = Portitemimg::all();

            // ↓ポートフォリオ閲覧画面
            return view("port.show", compact("port", "portitems", "portitemimgs"));
            // 原因不明エラーが起きた時
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("ports.error")->with('value', "2");
        }

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
        // 削除処理

        $port = Port::findOrFail($id);
        $portitems = Portitem::where('port_id', $port->id)->get();

        foreach ($portitems as $portitem) {
            $portitemimgs = Portitemimg::where('portitem_id', $portitem->id)->get();
            foreach ($portitemimgs as $portitemimg) {
                // ↓ポートフォリオ項目画像テーブルの削除ができているのかを真偽判定しています。
                if ($portitemimg->delete()) {

                } else {
                    // ↓ポートフォリオ閲覧画面
                    return redirect()->route("ports.show", $port->id)->with('showdeleteerror', $port->titlename . "削除に失敗しました1");
                }
            }
            // ↓ポートフォリオ項目テーブルの削除ができているのかを真偽判定しています。
            if ($portitem->delete()) {

            } else {
                // ↓ポートフォリオ閲覧画面
                return redirect()->route("ports.show", $port->id)->with('showdeleteerror', $port->titlename . "削除に失敗しました2");
            }
        }
        // ↓ポートフォリオが削除できているのかを真偽判定しています。
        if ($port->delete()) {
            $ports = Port::all();
            
            // ↓ポートフォリオ一覧画面
            return view("port.index", compact("ports"));
        } else {
            // ↓ポートフォリオ閲覧画面
            return redirect()->route("ports.show", $port->id)->with('showdeleteerror', $port->titlename . "削除に失敗しました3");
        }
    }

    public function error(PortRequest $request)
    {
        // ↓エラー画面
        return view("port.error");
    }

    public function logout(PortRequest $request)
    {
        try {
            // ログアウト処理

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // ↓ログインしていないのと、リンクエラーがおきていないのかを真偽判定しています。
            if (!Auth::check() || !view()->exists('port.logout')) {
                // ↓ログイン画面
                return redirect()->route("users.index");
            } else {
                // ↓エラー画面
                return redirect()->route("ports.error")->with('value', "1");
            }
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("ports.error")->with('value', "2");
        }
    }
}
