<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\categories;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض قائمة المنتجات
    public function index()
    {
        $products = Product::with('category', 'user')->paginate(10);// جلب المنتجات مع التصنيفات والمستخدمين
        return view('admin.products.index', compact('products'));
    }

    // عرض صفحة إضافة منتج
    public function create()
    {
        $categories = categories::all(); // جلب جميع التصنيفات
        return view('admin.products.create', compact('categories'));
    }

    // تخزين المنتج الجديد
    public function store(Request $request)
    {
        // التحقق من المدخلات
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'status' => 'required|in:available,sold,swapped',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // التحقق من الصورة
        ]);

        // رفع الصورة (إذا كانت موجودة)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // تخزين المنتج في قاعدة البيانات
        Product::create([
            'user_id' => auth()->id(), // المستخدم المسؤول عن الإضافة
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product added successfully.');
    }

    // عرض صفحة تعديل منتج
    public function edit($id)
    {
        $product = Product::findOrFail($id); // جلب المنتج بناءً على الـ ID
        $categories = categories::all(); // جلب التصنيفات
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // تحديث المنتج
    public function update(Request $request, $id)
    {
        // التحقق من المدخلات
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'status' => 'required|in:available,sold,swapped',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // التحقق من الصورة
        ]);

        $product = Product::findOrFail($id); // جلب المنتج الذي سيتم تحديثه

        // رفع الصورة الجديدة إذا كانت موجودة
        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($product->image) {
                unlink(storage_path('app/public/' . $product->image));
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // تحديث المنتج في قاعدة البيانات
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    // حذف المنتج
    public function destroy($id)
    {
        $product = Product::findOrFail($id); // جلب المنتج
        // حذف الصورة القديمة إذا كانت موجودة
        if ($product->image) {
            unlink(storage_path('app/public/' . $product->image));
        }
        // حذف المنتج
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }
}
