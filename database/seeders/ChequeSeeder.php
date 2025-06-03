<?php

namespace Database\Seeders;

use App\Models\Cheque;
use Illuminate\Database\Seeder;

class ChequeSeeder extends Seeder
{
    public function run(): void
    {
        Cheque::factory()->count(10)->create();
    }
}