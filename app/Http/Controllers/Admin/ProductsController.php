<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Image;

use App\Models\Product;
use App\Models\Genre;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index')
            ->with('products', $products);
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.products.create')
            ->with('genres', $genres);
    }

    public function store(ProductRequest $request)
    {
        $image = $this->saveImage($request->file('image'));

        $product = new Product();
        $product->genre_id       = $request['genre'];
        $product->name           = $request['name'];
        $product->image          = $image;
        $product->introduction   = $request['introduction'];
        $product->price          = $request['price'];
        $product->is_active      = $request['is_active'];
        $product->save();

        return redirect(route('admin.products.index'))
            ->with('status', '商品を登録しました');
    }

    public function onlySelling()
    {
        $products = Product::where('is_active', true)->get();
        return view('admin.products.index')
            ->with('products', $products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        $tax_price = 1.10;
        return view('admin.products.show')
            ->with('product', $product)
            ->with('tax_price', $tax_price);
    }

    public function edit($id)
    {
        $genres = Genre::all();
        $product = Product::find($id);
        return view('admin.products.edit')
            ->with('product', $product)
            ->with('genres', $genres);
    }

    public function update(ProductRequest $request, $id)
    {

        $image = $this->saveImage($request->file('image'));

        $product = Product::find($id);
        $product->genre_id       = $request['genre'];
        $product->name           = $request['name'];
        $product->image          = $image;
        $product->introduction   = $request['introduction'];
        $product->price          = $request['price'];
        $product->is_active      = $request['is_active'];
        $product->save();

        return redirect(route('admin.products.show', [$product->id]))
            ->with('status', '商品を更新しました。');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect(route('admin.products.index'));
    }

    private function saveImage(UploadedFile $file): string
    {
        $path = $this->emptyFile();
        Image::make($file)->fit(300, 300)->save($path); //\Image::make('***')でファイルを読み込む
        $filePath = Storage::disk('public')
            ->putFile('images', new File($path)); //保存する先の指定　 public/strage/item-imagesに作る
        return basename($filePath); // パスからファイル名のみ取得する
    }
    /**
      * 一時的なファイルを生成してパスを返します。
      *
      * @return string ファイルパス
      */
    private function emptyFile(): string
    {
        $tmp_file = tmpfile(); //一時ファイルを作ってスクリプト処理が終了したタイミングで削除する
        $meta   = stream_get_meta_data($tmp_file); //メタデータを取得する
        return $meta["uri"];
    }
}
