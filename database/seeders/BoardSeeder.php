<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BoardSeeder extends Seeder{

    public function run(){

        $categories = ['Africa', 'Asia', 'China', 'Commodities', 'Currencies', 'Crypto', 'EFTs', 'Entertainment', 'EU', 'Goods',
                                'Finance', 'Food', 'Indices', 'Insurance', 'North America', 'Ociean', 'Pharma', 'South America', 'Stocks', 'Tech', 
                                'US'];

        foreach($categories as $category){
            DB::table('boards')->insert([
                'category' => $category,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
