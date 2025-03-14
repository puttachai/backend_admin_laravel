<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Seller;

class SellerProductController extends Controller
{
    public function index($seller_id)
    {
        // $seller = Seller::where('seller_id', $seller_id)->firstOrFail();
        // $products = Product::where('seller_id', $seller_id)->get();
        // $products = Product::with('seller')->get(); // ดึงสินค้าทั้งหมด พร้อมข้อมูลผู้ขาย
        $products = Product::with('seller')->paginate(15); // กำหนดให้แสดงผล 15 รายการต่อหน้า
        return view('seller.products.product-seller', compact('products', 'products'));
    }

    public function create($seller_id)
    {
        $seller = Seller::where('seller_id', $seller_id)->firstOrFail();
        return view('seller.products.create', compact('seller'));
    }

    public function store(Request $request, $seller_id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'qty' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $product = new Product();
        $product->seller_id = $seller_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('seller.products', $seller_id)->with('success', 'เพิ่มสินค้าเรียบร้อยแล้ว!');
    }

    public function edit($seller_id, $id)
    {
        $seller = Seller::where('seller_id', $seller_id)->firstOrFail();
        $product = Product::where('id', $id)->where('seller_id', $seller_id)->firstOrFail();

        // return view('seller.products.edit', compact('seller', 'product'));
        return view('seller.products.edit-product-seller', compact('seller', 'product'));
    }

    public function update(Request $request, $seller_id, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'qty' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $product = Product::where('id', $id)->where('seller_id', $seller_id)->firstOrFail();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('sellers.products', $seller_id)->with('success', 'อัปเดตสินค้าเรียบร้อยแล้ว!');
    }

    public function destroy($seller_id, $id)
    {
        $product = Product::where('id', $id)->where('seller_id', $seller_id)->firstOrFail();
        $product->delete();

        return redirect()->route('seller.products', $seller_id)->with('success', 'ลบสินค้าเรียบร้อยแล้ว!');
    }
}
