<?php namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Product;
use App\Category;
use App\SubscriptionPrice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller {
    private $testStripeKey;

    public function __construct() {
        $this->testStripeKey = 'sk_test_zn5nqihQEIqTuw7cjJ8VygeX';
    }

    public function membersProducts() {
        $products = Product::where('type', 'members')->get();

        return view('products', ['products' => $products]);
    }

    public function product($slug, $id) {
        $product = Product::where('slug', $slug)->where('id', $id)->first();

        return view('expand_product', ['product' => $product]);
    }

    public function addProductView() {
        $products = Product::orderBy('id', 'desc')->limit(10)->get();
        $categories = Category::all();

        return view('admin.add_product', ['products' => $products, 'categories' => $categories]);
    }

    public function preAddNewProduct(Request $request) {
        $title          = request()->input('title');
        $snippet        = request()->input('snippet');
        $body           = request()->input('body');
        $type           = request()->input('type');
        $categoryId     = request()->input('category');

        $this->validateNewProductAddition($request);

        $ebookFileDir = $this->storeEbook();
        $thumbnailFileDir = $this->storeThumbnail();

        $productInfo = ['title' => $title, 'snippet' => $snippet, 'body' => $body, 'type' => $type, 'ebookFileDir' => $ebookFileDir, 'thumbnailFileDir' => $thumbnailFileDir, 'categoryId' => $categoryId];
        $this->addProduct($productInfo);

        return back()->with('messsage', 'Product added');
    }

    private function storeEbook() {
        $fileDir = false;
        $file = request()->file('ebook');

        if ($file) {
            return Storage::putFile('ebooks', $file);
        }

        return $fileDir;
    }

    private function storeThumbnail() {
        $fileDir = false;
        $file = request()->file('thumbnail');

        if ($file){
            return Storage::disk('public')->putFile('images/thumbnails', $file);
        }

        return $fileDir;
    }

    public function downloadEbook($productId) {
        if (auth()->check()) {
            if ($this->isProductSubscribers($productId)) {
                if($this->isUserSubscriber()) {
                    return $this->returnDownload($productId);
                }

                return redirect()->route('subscribe');
            }

            if ($this->isProductMembers($productId)) {
                return $this->returnDownload($productId);
            }
        }

        return redirect()->route('subscribe');
    }

    private function isProductSubscribers($productId) {
        return Product::find($productId)->type == 'subscribers';
    }

    public function returnDownload($productId) {
        if (Order::where('user_id', auth()->user()->id)) {
            $product = Product::find($productId);
            return Storage::download($product->download, Str::slug($product->title) . '.pdf', ['Content-Type: application/pdf']);
        }
    }

    private function isUserSubscriber() {
        $user =  User::find(auth()->user()->id);

        if($user->orders()->orderBy('id', 'desc')->whereDate('expires', '>', now())->exists()) {
            return true;
        }

        return false;
    }

    public function isProductMembers($productId) {
        return Product::find($productId)->type == 'members';
    }

    public function expandCategory($slug, $id) {
        $category = Category::find($id);
        $products = $category->products;

        return view('products', ['products' => $products, 'category' => $category]);
    }

    public function index() {
        $products = Product::orderBy('id', 'desc')->get();
        return view('products', ['products' => $products]);
    }

    public function subscribePage() {
        $subscription = SubscriptionPrice::all();
        $subscriptionIsActive = $this->isSubscriptionActive();

        return view('subscribe', ['subscription' => $subscription, 'subscriptionIsActive' => $subscriptionIsActive]);
    }

    public function subscriberArea() {
        if (! auth()->check() ) {
            return redirect()->route('become.a.member');
        }

        $products = Product::where('type', 'subscribers')->get();
        $categories = Category::all();

        return view('products', ['products' => $products, 'categories' => $categories]);
    }

    public function subscribe() {
        if ($this->isSubscriptionActive()) {
            header('HTTP/1.0 403 Forbidden');
        }

        \Stripe\Stripe::setApiKey($this->testStripeKey);

        $token = request()->input('stripeToken');
        $priceId = request()->input('subscription_id');

        $subscription = SubscriptionPrice::find($priceId);

        try {
            $charge = $this->createStripeCharge($subscription, $token);

            $expires = now();
            $paid = 0;

            if ($charge->paid == 'true') {
                $paid = 1;
                $expires = now()->addMonth($subscription->months);
            }

            $this->createOrder($charge, $paid, $expires);

            if ($paid == 0) {
                return back()->with('message', 'We couldn\'t charge your card');
            } else {
                return redirect()->route('subscriber.area')->with('message', 'Purchase successful');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['We could\'nt make the payment']);

            Log::info($e);
        }
    }

    public function isSubscriptionActive() {
        $subscriptionIsActive = false;

        if (auth()->check()) {
            $userOrder = User::find(auth()->user()->id)->orders();

            if($userOrder->exists()) {
                if($userOrder->orderBy('id', 'desc')->whereDate('expires', '>', now())->exists()) {
                    $subscriptionIsActive =  true;
                }
            }
        }

        return $subscriptionIsActive;
    }

    private function createStripeCharge($subscription, $token) {
        $charge = \Stripe\Charge::create([
            'amount' => $subscription->price * 100,
            'currency' => 'gbp',
            'description' => $subscription->description,
            'source' => $token,
        ]);
        return $charge;
    }

    private function createOrder($charge, $paid, $expires) {
        $order = new Order([
            'order' => json_encode($charge),
            'paid' => $paid,
            'subscribe_date' => now(),
            'expires' => $expires,
        ]);

        $user = User::find(auth()->user()->id);
        $user->orders()->save($order);
    }

    private function validateNewProductAddition(Request $request) {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'snippet' => 'required',
            'type' => 'required',
            'body' => 'required',
            'ebook' => 'required|file',
            'thumbnail' => 'required',
        ]);
    }

    private function addProduct($productInfo) {
        Product::create([
            'title' => $productInfo['title'],
            'snippet' => $productInfo['snippet'],
            'slug' => Str::slug($productInfo['slug']),
            'body' => $productInfo['body'],
            'type' => $productInfo['type'],
            'download' => $productInfo['ebookFileDir'],
            'thumbnail' => $productInfo['thumbnailFileDir'],
            'category_id' => $productInfo['categoryId'],
        ]);
    }
}
