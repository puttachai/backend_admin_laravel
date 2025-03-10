<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductNew;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product', compact('products'));
        // return view('product', compact('products', 'categories'));
    }
    public function createProduct()
    {
        // $products = Product::all();
        $categories = Categories::all(); // Fetch all categories or modify this based on your needs
        return view('Create_product', compact('categories'));
        // return view('product', compact('products', 'categories'));
    }

    //categories
    public function categories()
    {
        $categoriess = Categories::all();
        return view('categories', compact('categoriess'));
    }

    //show
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('status', 'Product not found');
        }

        return view('show', compact('product'));

        // $productId = $request->query('id');
        // $productName = $request->query('name');
        
        // return view('show', compact('productId', 'productName'));
    }

    //store Product
    public function store(Request $request)
    {

            // บันทึกข้อมูลที่ได้รับจาก request
        Log::info('Request Data: ', $request->all());
        
        // ตรวจสอบค่า emp_id ก่อนการบันทึก
        $emp_id = auth()->user()->emp_id;
        Log::info('emp_id to be saved: ', ['emp_id' => $emp_id]);

        // $seller_id = session('seller_id');  // ดึงค่า seller_id จาก session
         // ตรวจสอบค่า seller_id
        //  Log::info('Log seller_id:', ['seller_id' => $seller_id]);
        
         // ตรวจสอบว่ามี seller_id หรือไม่
        // if (!$seller_id) {
        //     return redirect()->route('login')->withErrors('กรุณาล็อกอินก่อน');
        // }

        $request->validate([
            'barcode' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
            'description' => 'nullable|string',
            'categories_id' => 'required|exists:categories,id', // ตรวจสอบว่าหมวดหมู่มีอยู่ในฐานข้อมูล
            'image-upload' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048', // ข้อกำหนดสำหรับการอัปโหลดภาพ
            // 'seller_id' => 'required', // Ensure this is validated
            ]);

        $imagePath = null;
        // $secondImagePath = null;
        if ($request->hasFile('image-upload')) {
            $image = $request->file('image-upload');

            // Save to 'public/images/products'
            $imagePath = $image->store('', 'product_images');

            // Copy to another directory in a different drive
            $secondDirectoryPath = 'D:\project-e-commerce-react\frontend\public\images\product'; // ไดร์ฟและโฟลเดอร์ปลายทางที่ต้องการ
            //$imageName = $image->getClientOriginalName(); // ชื่อไฟล์เดิม

            // Move the file to the second location
            $image->move($secondDirectoryPath,$imagePath);//$imageName

            // หรือใช้การ copy() ถ้าต้องการเก็บไว้ทั้งสองที่
            // \File::copy(storage_path('app/public/images/products/'.$imagePath), $secondDirectoryPath.'/'.$imageName);
        }

        // บันทึกข้อมูลผลิตภัณฑ์ // ใช้พาธของภาพ
        ProductNew::create([
        // Product::create([
            'emp_id' => $emp_id,
            'barcode' => $request->input('barcode'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'qty' => $request->input('qty'),
            'description' => $request->input('description'),
            'categories_id' => $request->input('categories_id'),  // เก็บหมวดหมู่ที่เลือก
            'image' => $imagePath, 
            
            // 'seller_id' => $seller_id // ใช้ ID ของผู้ใช้งานที่ล็อกอิน
            
            // 'seller_id' => auth()->user()->id, // ใช้ ID ของผู้ใช้งานที่ล็อกอิน
            //'second_image' => $secondImagePath, // บันทึกพาธของภาพที่สอง (ถ้าต้องการ)
            
        ]);

        return redirect()->route('product.index')->with('status', 'Product created successfully!');
    }


    //store_categories
    public function store_categories(Request $request)
    {
        
        $request->validate([
            'type_barcode' => 'required|string|max:255',
            'type_name' => 'required|string|max:255',
            // 'type_price' => 'required|numeric',
            // 'type_qty' => 'required|integer',
            'type_description' => 'nullable|string',
            'image-upload' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048', // ข้อกำหนดสำหรับการอัปโหลดภาพ
            // 'type_imageBackup' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'type_status' => 'required|boolean',
        ]);

        $imagePath = null;
        $secondImagePath = null;
        if ($request->hasFile('image-upload')) {
            $image = $request->file('image-upload');

            // Save to 'public/images/products'
            $imagePath = $image->store_categories('', 'categories_images');

            // Copy to another directory in a different drive
            $secondDirectoryPath = 'C:\project-e-commerce-react\frontend\public\images\categories'; // ไดร์ฟและโฟลเดอร์ปลายทางที่ต้องการ
            //$imageName = $image->getClientOriginalName(); // ชื่อไฟล์เดิม

            // Move the file to the second location
            $image->move($secondDirectoryPath,$imagePath);//$imageName

            // หรือใช้การ copy() ถ้าต้องการเก็บไว้ทั้งสองที่
            // \File::copy(storage_path('app/public/images/products/'.$imagePath), $secondDirectoryPath.'/'.$imageName);
        }

            // ตรวจสอบและบันทึกภาพสำรอง
        if ($request->hasFile('type_imageBackup')) {
            $backupImage = $request->file('type_imageBackup');
            // เก็บภาพสำรองในไดเรกทอรีและเก็บพาธของภาพสำรองลงฐานข้อมูล
            $backupImagePath = $backupImage->store_categories('', 'categories_images');
            $secondDirectoryPath = 'C:\project-e-commerce-react\frontend\public\images\categories'; // ไดร์ฟและโฟลเดอร์ปลายทางที่ต้องการ
            $backupImage->move($secondDirectoryPath, $backupImagePath);
        }

        // บันทึกข้อมูลผลิตภัณฑ์
        Categories::create([
            'type_barcode' => $request->input('type_barcode'),
            'type_name' => $request->input('type_name'),
            // 'type_price' => $request->input('type_price'),
            // 'type_qty' => $request->input('type_qty'),
            'type_description' => $request->input('type_description'),
            'type_image' => $imagePath,
            'type_imageBackup' => $secondImagePath,
            'type_status' => $request->input('type_status', 1), // เพิ่มค่าเริ่มต้นสำหรับสถานะ
        ]);

        return redirect()->route('categories.categoriess')->with('status', 'categories Product created successfully!');
    }

        public function edit($id)
        {
            Log::info('Log id product: ', ['id' => $id]);
            $product = Product::findOrFail($id);
            $categories = Categories::all(); // ดึงข้อมูลหมวดหมู่ทั้งหมด
            return view('edit-product', compact('product', 'categories'));
        }


        public function update(Request $request, $id)
        {
            Log::info('Log request product: ', ['request' => $request]);

            $product = Product::findOrFail($id);

            Log::info('Log product: ', ['product' => $product]);
            
            $request->validate([
                'barcode' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'qty' => 'required|integer',
                'description' => 'nullable|string',
                'categories_id' => 'required|exists:categories,categories_id', // ตรวจสอบว่ามีหมวดหมู่นี้จริง
            ]);

            $product->update([
                'barcode' => $request->input('barcode'),
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'qty' => $request->input('qty'),
                'categories_id' => $request->categories_id, // บันทึกหมวดหมู่ที่เลือก
                'description' => $request->input('description'),
            ]);

            return redirect()->route('product.index')->with('status', 'Product updated successfully!');
        }

        // Method สำหรับลบข้อมูล product
        public function destroy($id)
        {
            // ค้นหาผลิตภัณฑ์ที่มี id ที่ตรงกับที่ได้รับจาก URL
            $product = ProductNew::findOrFail($id);

            // Log ข้อมูลการลบ
            Log::info("Deleting product with ID: {$id}", ['product' => $product]);

            // ลบข้อมูลผลิตภัณฑ์
            $product->delete();

            // ส่งผู้ใช้กลับไปที่หน้าแสดงรายการผลิตภัณฑ์
            return redirect()->route('product.index')->with('status', 'Product deleted successfully!');
        }
    
    //edit
    // public function edits($id)
    //     {
    //         $product = Product::findOrFail($id);
    //         return view('products.edit', compact('product'));
    //     }

    //     public function destroy($id)
    //     {
    //         $product = Product::findOrFail($id);
    //         $product->delete();
    //         return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    //     }


        



    // public function show(Request $request)
    // {
    //     $productId = $request->query('id');
    //     $productName = $request->query('name');
        
    //     return view('show', compact('productId', 'productName'));
    // }

}
