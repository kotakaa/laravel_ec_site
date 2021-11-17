<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Requests\GenreRequest;
use App\Http\Controllers\Controller;

class GenresController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genres.index')
            ->with('genres', $genres);
    }

    public function store(GenreRequest $request)
    {
        \DB::beginTransaction();
        try{
            Genre::create([
                'name' => $request['name']
            ]);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            return redirect(route('admin.genres.index'))
                ->with('status', 'ジャンルを登録できませんでした');
        }
        return redirect(route('admin.genres.index'))
            ->with('status', 'ジャンルを作成しました。');
    }

    public function edit($id)
    {
        $genre = Genre::find($id);
        return view('admin.genres.edit')
            ->with('genre', $genre);
    }

    public function update(GenreRequest $request, $id)
    {
        $genre = Genre::find($id);
        \DB::beginTransaction();
        try{
            $genre->name = $request['name'];
            $genre->save();
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            about(500);
        }
        return redirect(route('admin.genres.index'))
            ->with('status', 'ジャンルを更新しました。');
    }

    public function destroy($id)
    {
        $genre = Genre::find($id);
        $genre->delete();

        return redirect(route('admin.genres.index'))
            ->with('status', 'ジャンルを削除しました。');
    }
}
