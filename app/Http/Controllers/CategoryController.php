<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log; // ใช้ Log facade

class CategoryController extends Controller
{
    //ฟังก์ชันสำหรับการแสดงฟอร์มสร้าง Category
    public function create()
    {
        return view('categories');
    }

    public function index()
    {
        $category = Categories::all();
        return view('categories', compact('category'));
    }


    public function edit($id)
    {
        $categories = Categories::findOrFail($id);
        return view('edit-categories', compact('categories'));
    }

    public function destroy($id)
        {
            $categories = Categories::findOrFail($id);
            $categories->delete();
            return redirect()->route('categories.index')->with('success', 'Product deleted successfully');
        }


        public function update(Request $request, $id)
        {
            $categories = Categories::findOrFail($id);

            // ตรวจสอบ validate
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // อัปโหลดรูปภาพใหม่ ถ้ามี
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('categories', 'public');
                $categories->image = $imagePath;
            }

            // อัปเดตข้อมูล
            $categories->name = $request->name;
            $categories->description = $request->description;
            $categories->save();

            return redirect()->route('categories.index')->with('success', 'Category updated successfully');
        }


         //show
    public function show($id)
    {
        $categories = Categories::find($id);

        if (!$categories) {
            return redirect()->route('categories.index')->with('status', 'Product not found');
        }

        return view('show-categories', compact('categories'));

    }



    // ฟังก์ชันสำหรับการบันทึกข้อมูล Category
    public function storeCategory(Request $request)
    {

        // dd($request->all());

        // Log ข้อมูลที่กรอกเข้ามาในฟอร์มก่อนที่จะทำการบันทึก
        Log::info('Received data from form:', [
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $request->file('image') ? $request->file('image')->getClientOriginalName() : null,
        ]);


        // validate ใช้แล้วไม่บันทึกลง ฐานข้อมูล Database
        // ตรวจสอบค่าที่กรอกในฟอร์ม 
        // $request->validate([
        //     'id' => 'required|integer|max:999',
        //     'name' => 'required|string|max:100',
        //     'description' => 'nullable|string',
        //     'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // กำหนดประเภทไฟล์ที่อนุญาต
        // ]);


        // Log ค่าที่รับจากฟอร์ม
        Log::info('Category data received:', [
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->hasFile('image') ? $request->file('image')->getClientOriginalName() : 'No image uploaded'
        ]);


        // บันทึกไฟล์ภาพถ้ามี
        $imagePath = null;
        // $secondImagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Save to 'public/images/products'
            $imagePath = $image->store('', 'product_images');

            // Copy to another directory in a different drive
            $secondDirectoryPath = 'D:\project-e-commerce-react\frontend\public\images\product'; // ไดร์ฟและโฟลเดอร์ปลายทางที่ต้องการ
            // Move the file to the second location
            $image->move($secondDirectoryPath,$imagePath);//$imageName

           
        }

        // บันทึกข้อมูลลงในตาราง categories
        // บันทึกข้อมูลลงในตาราง categories
        $category = Categories::create([
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath, // เก็บ path ของไฟล์
        ]);

         // Log ข้อมูลที่บันทึกลงฐานข้อมูล
         Log::info('Category saved to database:', [
            'categories_id' => $category->categories_id, // categories_id เป็น AUTO_INCREMENT
            'id' => $category->categories_id,
            'name' => $category->name,
            'description' => $category->description,
            'image' => $category->image
        ]);


        // คืนค่ากลับไปยังหน้าฟอร์มและแสดงข้อความสถานะ
        return redirect()->route('categories')->with('status', 'Category created successfully!');
    }



}
