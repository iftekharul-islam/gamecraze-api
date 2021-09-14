<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportLocationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportLocatoins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Divisions, Districts, Thanas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "----Importing locations----\n";

        DB::statement("SET foreign_key_checks=0");
        // Area::truncate();
        Thana::truncate();
        District::truncate();
        Division::truncate();
        DB::statement("SET foreign_key_checks=1");

        if ($this->divisions()) {
            echo "Importing divisions........\n";
            foreach($this->divisions() as $division) {
                Division::create($division);
            }
        }

        if ($this->districts()) {
            echo "Importing districts........\n";
            foreach($this->districts() as $district) {
                District::create($district);
            }
        }

        if ($this->upazillas()) {
            echo "Importing upazillas........\n";
            foreach($this->upazillas() as $upazilla) {
                Thana::create($upazilla);
            }
        }

        // if ($this->unions()) {
        //     echo "Importing area........\n";
        //    foreach($this->unions() as $union) {
        //        Area::create($union);
        //    }
        // }

        echo "----Done----\n";
    }

    public function divisions() {
        $path = public_path() . "/location/bd-divisions.json";
        $divisions = json_decode(file_get_contents($path), true);

        return $divisions['divisions'];
    }

    public function districts() {
        $path = public_path() . "/location/bd-districts.json";
        $districts = json_decode(file_get_contents($path), true);

        return $districts['districts'];
    }

    public function upazillas() {
        $path = public_path() . "/location/bd-upazilas.json";
        $upazillas = json_decode(file_get_contents($path), true);

        return $upazillas['upazilas'];
    }
}
