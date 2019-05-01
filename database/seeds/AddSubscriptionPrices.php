<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddSubscriptionPrices extends Seeder {
    public function run() {
        DB::table('subscription_prices')->insert([
            [
                'months' => 1,
                'price' => 3,
                'title' => '1 Month membership',
                'description' => 'Aliquam malesuada augue mi, volutpat vulputate tellus porttitor id. Quisque quis quam eu lacus pharetra mattis. Aliquam erat volutpat. Suspendisse condimentum imperdiet neque, id euismod lacus imperdiet eu. Fusce vitae libero turpis. '
            ], [
                'months' => 2,
                'price' => 5.50,
                'title' => '2 Months membership',
                'description' => 'Aliquam malesuada augue mi, volutpat vulputate tellus porttitor id. Quisque quis quam eu lacus pharetra mattis. Aliquam erat volutpat. Suspendisse condimentum imperdiet neque, id euismod lacus imperdiet eu. Fusce vitae libero turpis. '
            ], [
                'months' => 3,
                'price' => 8,
                'title' => '3 Months membership',
                'description' => 'Aliquam malesuada augue mi, volutpat vulputate tellus porttitor id. Quisque quis quam eu lacus pharetra mattis. Aliquam erat volutpat. Suspendisse condimentum imperdiet neque, id euismod lacus imperdiet eu. Fusce vitae libero turpis. '
            ],
        ]);
    }
}
