<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\CSVDataModel;
use Exception;

class csvdata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statsdata:update {--url=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Takes in data in csv format and puts into database';

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
        $url = $this->option('url');

        $this->info('Seeding Database from CSV file');

        $csv = file_get_contents($url);

        $this->csvToDatabase($csv);

        $this->info('Seeding Complete');
        return 0;
    }

    public function csvToDatabase($data)
    {
        try{
            $lines = explode(PHP_EOL, $data);
            $csvArray = array();
            foreach ($lines as $line) {
                $csvArray[] = str_getcsv($line);
            }

            $bar = $this->output->createProgressBar(count($csvArray));

            $bar->start();

            for ($i = 1; $i < count($csvArray); $i++) {
                $csvData = new CSVDataModel();
                $csvData->entry_id = $csvArray[$i][0];
                $csvData->state_patient_number = $csvArray[$i][1];
                $csvData->date_announced = $csvArray[$i][2];
                $csvData->age_bracket = $csvArray[$i][3];
                $csvData->gender = $csvArray[$i][4];
                $csvData->detected_city = $csvArray[$i][5];
                $csvData->detected_district = $csvArray[$i][6];
                $csvData->detected_state = $csvArray[$i][7];
                $csvData->state_code = $csvArray[$i][8];
                $csvData->num_cases = $csvArray[$i][9];
                $csvData->current_status = $csvArray[$i][10];
                $csvData->contracted_from_which_patient_suspected = $csvArray[$i][11];
                $csvData->notes = $csvArray[$i][12];
                $csvData->source_1 = $csvArray[$i][13];
                $csvData->source_2 = $csvArray[$i][14];
                $csvData->source_3 = $csvArray[$i][15];
                $csvData->nationality = $csvArray[$i][16];
                $csvData->type_of_transmission = $csvArray[$i][17];
                $csvData->status_change_date = $csvArray[$i][18];
                $csvData->patient_number = $csvArray[$i][19];
                $csvData->save();
                $bar->advance();
            }

            $bar->finish();
        }catch(Exception $e){
            $this->error('Error Seeding Database File');
        }
    }
}

//     [0] => Entry_ID
//     [1] => State Patient Number
//     [2] => Date Announced
//     [3] => Age Bracket
//     [4] => Gender
//     [5] => Detected City
//     [6] => Detected District
//     [7] => Detected State
//     [8] => State code
//     [9] => Num Cases
//     [10] => Current Status
//     [11] => Contracted from which Patient (Suspected)
//     [12] => Notes
//     [13] => Source_1
//     [14] => Source_2
//     [15] => Source_3
//     [16] => Nationality
//     [17] => Type of transmission
//     [18] => Status Change Date
//     [19] => Patient Number
