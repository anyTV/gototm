<?php

use Illuminate\Database\Seeder;

use App\Rule;

class RedirectRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('redirect_rules')->delete();

        Rule::create([
            'long_url' => 'https://www.freedom.tm/',
            'short_url' => 'freedom',
            ]);

        Rule::create([
            'long_url' => 'https://www.freedom.tm/dashboard',
            'short_url' => 'freedom/dashboard',
            ]);

        Rule::create([
            'long_url' => 'https://www.freedom.tm/dashboard/lfg',
            'short_url' => 'freedom/dashboard/lfg',
            ]);

        Rule::create([
            'long_url' => 'https://www.freedom.tm:8000',
            'short_url' => 'port',
            ]);

        Rule::create([
            'long_url' => 'https://www.freedom.tm:8000/page',
            'short_url' => 'port/page',
            ]);
    }
}
