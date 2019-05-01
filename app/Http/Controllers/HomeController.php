<?php namespace App\Http\Controllers;

use App\Category;
use App\Product;

class HomeController extends Controller {
    public function index() {
        $products = Product::orderBy('id', 'desc')->get();
        $categories = Category::all();

        return view('index', ['products' => $products, 'categories' => $categories]);
    }
}