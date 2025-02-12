<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pina;

// 以下の2行を追記することで、Chronicle Model, Carbonクラスが扱えるようになる
use App\Models\Chronicle;
use Carbon\Carbon;

class PinaController extends Controller
{
    public function add()
    {
        return view('admin.pina.create');
    }


    public function create(Request $request)
    {
       
        // Validationを行う

        $this->validate($request, Pina::$rules);

        $pina = new Pina;
        $form = $request->all();

        // フォームから画像が送信されてきたら、保存して、$pina->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $pina->image_path = basename($path);
        } else {
            $pina->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $pina->fill($form);
        $pina->save();


        return redirect('admin/pina/create');
    }

    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Pina::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Pina::all();
        }
        return view('admin.pina.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    // 以下を追記
    public function edit(Request $request)
    {
        // Pina Modelからデータを取得する
        $pina = Pina::find($request->id);
        if (empty($pina)) {
            abort(404);
        }
        return view('admin.pina.edit', ['pina_form' => $pina]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Pina::$rules);
        // Pina Modelからデータを取得する
        $pina = Pina::find($request->id);
        // 送信されてきたフォームデータを格納する
        $pina_form = $request->all();

        if ($request->remove == 'true') {
            $pina_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $pina_form['image_path'] = basename($path);
        } else {
            $pina_form['image_path'] = $pina->image_path;
        }

        unset($pina_form['image']);
        unset($pina_form['remove']);
        unset($pina_form['_token']);

        // 該当するデータを上書きして保存する
        $pina->fill($pina_form)->save();
         
         $chronicle = new Chronicle();
         $chronicle->pina_id = $pina->id;
         $chronicle->edited_at = Carbon::now();
         $chronicle->save();

        return redirect('admin/pina');
    }
    // 以下を追記
    public function delete(Request $request)
    {
        // 該当するPina Modelを取得
        $pina = Pina::find($request->id);

        // 削除する
        $pina->delete();

        return redirect('admin/pina/');
    }
}
