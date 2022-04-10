<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
   {
       \DB::table('expenses')->insert([
       [ 'name' => 'sales'],
       ['name' => 'cogs'],
       ['name' => 'opex'],
       ['name' => 'capex'],
       ['name' => 'income'],
       ['name' => 'borrowing'],
       ['name' => 'repayment'],
       ['name' => 'others'],
   ]);
   
       
   }

}
