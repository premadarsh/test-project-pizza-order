<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Size;
use App\Models\Pizzaoptions;

class SiteInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:site-init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up environment');

        
        $this->migrateDatabase();
        $this->generateKey();
        $this->seedData();
        
    }

    /**
     * Migrate database
     */
    public function migrateDatabase()
    {
        $this->call('migrate');
    }

    /**
     * generate key
     */
    public function generateKey()
    {
        $this->call('key:generate');
    }

    /**
     * seed default data
     */
    public function seedData()
    {
        //Seed Size data
        $small = Size::firstOrCreate(['name' => 'small', 'price' => 12, 'position' => 1]);
        $medium = Size::firstOrCreate(['name' => 'medium', 'price' => 22, 'position' => 2]);
        $large = Size::firstOrCreate(['name' => 'large', 'price' => 30, 'position' => 3]);

        //Seed pizza options
        Pizzaoptions::firstOrCreate(['type' => 'topping', 'name' => 'Pepperoni', 'size_id' => $small->id, 'price' => 3]);
        Pizzaoptions::firstOrCreate(['type' => 'topping', 'name' => 'Pepperoni', 'size_id' => $medium->id, 'price' => 4]);
        Pizzaoptions::firstOrCreate(['type' => 'topping', 'name' => 'Pepperoni', 'size_id' => $large->id, 'price' => 0]);

        Pizzaoptions::firstOrCreate(['type' => 'extra_cheese', 'name' => 'Extra Cheese', 'size_id' => $small->id, 'price' => 6]);
        Pizzaoptions::firstOrCreate(['type' => 'extra_cheese', 'name' => 'Extra Cheese', 'size_id' => $medium->id, 'price' => 6]);
        Pizzaoptions::firstOrCreate(['type' => 'extra_cheese', 'name' => 'Extra Cheese', 'size_id' => $large->id, 'price' => 6]);
    }
}
