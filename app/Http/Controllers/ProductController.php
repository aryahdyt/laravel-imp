<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Product::without('merchant')->latest()->get();
        // dd($data);
        return view('product.index');
    }

    public function getProduct(Request $request)
    {
        // dd($request);
        if ($request->ajax()) {
            $data = Product::without('merchant');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('merchant', function (Product $product) {
                    return $product->merchant->merchant_name;
                })
                ->addColumn('action', function ($row) {
                    // $actionBtn = '<a href="' . route('product.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> <a href="' . route('product.destroy', $row->id) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    $btn = '<a href="' . route('product.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btnAction = $btn . "<form action='" . route('product.destroy', $row->id) . "' method='post'>" . csrf_field() . "" . method_field("DELETE") . "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(' Yakin hapus data ? ');'>X</button></form>";

                    return $btnAction;
                })
                ->rawColumns(['action'])
                ->make(true);
            // ->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merchant = Merchant::get();
        return view('product.create', ['merchant' => $merchant]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $product = Product::create($request->all());

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', [
            'product' => $product,
            'merchant' => Merchant::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request);

        $product->update($request->all());

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // dd($product);
        $product->delete();

        return redirect()->route('product.index');
    }
}
