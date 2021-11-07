<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'DESC')->simplePaginate(10);
        return view('pages.product', compact('products'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $products = Product::with('category')->where('name', 'like', '%' . $keyword . '%')->simplePaginate(10);
        return view('pages.product', compact('products'));
    }

    public function create()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        return view('pages.create', compact('category'));
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:225',
                'category_id' => 'required',
                'description' => 'required|max:1000',
                'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'second_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'size' => 'required',
            ]);

            if (!$validator->fails()) {

                if ($request->file('main_image')) {
                    $mainImage = time() . '.' . $request->main_image->extension();
                    $request->main_image->move(public_path('uploads'), $mainImage);
                }

                if ($request->file('second_image')) {
                    $secondImage = time() . '.' . $request->second_image->extension();
                    $request->second_image->move(public_path('uploads'), $secondImage);
                }

                $images = [
                    'main_image' => $mainImage,
                    'second_image' => $secondImage,
                ];

                $pricePerVariants = [
                    'variant_1' => $request->variant_1,
                    'price_1' => $request->price_1,
                    'variant_2' => $request->variant_2,
                    'price_2' => $request->price_2,
                    'variant_3' => $request->variant_3,
                    'price_3' => $request->price_3,
                ];

                $data = [
                    'name' => $request->name,
                    'categories_id' => $request->category_id,
                    'description' => $request->description,
                    'multiple_image' => json_encode($images),
                    'multiple_color' => json_encode($request->color),
                    'multiple_size' => json_encode($request->size),
                    'multiple_price' => json_encode($pricePerVariants),
                ];

                $createProduct = Product::create($data);

                DB::commit();

                return redirect()->route('product.index')->with('success', 'Successfully create new product');

            } else {

                DB::rollback();
                return redirect()->route('product.create')->withErrors($validator);

            }

        } catch (\Throwable$e) {
            DB::rollback();
            return redirect()->route('product.index')->with('failed', $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $category = Category::orderBy('id', 'DESC')->get();
        $product = Product::findOrFail($id);

        return view('pages.edit', compact('product', 'category'));
    }

    public function update(Request $request)
    {

        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:225',
                'category_id' => 'required',
                'description' => 'required|max:1000',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'second_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if (!$validator->fails()) {

                if ($request->file('main_image')) {
                    $mainImage = time() . '.' . $request->main_image->extension();
                    $request->main_image->move(public_path('uploads'), $mainImage);
                } else {
                    $mainImage = $request->old_main_image;
                }

                if ($request->file('second_image')) {
                    $secondImage = time() . '.' . $request->second_image->extension();
                    $request->second_image->move(public_path('uploads'), $secondImage);
                } else {
                    $secondImage = $request->old_second_image;
                }

                $images = [
                    'main_image' => $mainImage,
                    'second_image' => $secondImage,
                ];

                $pricePerVariants = [
                    'variant_1' => $request->variant_1,
                    'price_1' => $request->price_1,
                    'variant_2' => $request->variant_2,
                    'price_2' => $request->price_2,
                    'variant_3' => $request->variant_3,
                    'price_3' => $request->price_3,
                ];

                $data = [
                    'name' => $request->name,
                    'categories_id' => $request->category_id,
                    'description' => $request->description,
                    'multiple_image' => json_encode($images),
                    'multiple_color' => (!empty($request->color)) ? json_encode($request->color) : $request->old_color,
                    'multiple_size' => (!empty($request->size)) ? json_encode($request->size) : $request->old_size,
                    'multiple_price' => json_encode($pricePerVariants),
                ];

                $id = $request->id;

                $updateProduct = Product::whereId($id)->update($data);

                DB::commit();

                return redirect()->route('product.index')->with('success', 'Successfully update a product');

            } else {

                DB::rollback();
                return redirect()->route('product.create')->withErrors($validator);

            }

        } catch (\Throwable$e) {
            DB::rollback();
            return redirect()->route('product.index')->with('failed', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {

            $id = $request->id;
            $product = Product::find($id);
            if ($product->delete()) {
                return redirect()->route('product.index')->with('success', 'Successfully remove a product');
            }
            return redirect()->route('product.index')->with('failed', 'Fail to remove a product');
        } catch (\Throwable$e) {
            return redirect()->route('product.index')->with('failed', $e->getMessage());
        }
    }

}
