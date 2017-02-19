<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $data = [
                [
                'links_name'=> 'watermoe',
                'links_title'=> '',
                'links_url'  => 'watermoe.club',
                'links_order'=> 1
                ],
                [
                'links_name'=> 'watermoe2',
                'links_title'=> '',
                'links_url'  => 'watermoe.club',
                'links_order'=> 2
            ]
            ];
            DB::table('links')->insert($data);
    }
}
