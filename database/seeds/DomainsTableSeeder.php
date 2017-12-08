<?php

use Illuminate\Database\Seeder;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Domain::class, 3)->create()->each(function ($domain) {
            for($i=1;$i<=3;$i++) {
                $domain->pages()->save(factory(App\Page::class)->make());
            }
        });
    }
}
