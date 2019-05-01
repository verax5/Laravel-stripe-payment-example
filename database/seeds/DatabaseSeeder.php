<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() {
        $this->call(AddCategories::class);
        $this->call(AddSubscriptionPrices::class);
        $this->Call(AddAdminAccountSeeder::class);
    }
}
