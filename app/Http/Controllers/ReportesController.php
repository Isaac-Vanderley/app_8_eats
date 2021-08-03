<?php

namespace App\Http\Controllers;
use PHPJasper\PHPJasper;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function compilarReporteNegocios(){

    
        $input =  'C:\Users\vande\JaspersoftWorkspace\MyReports\ReporteNegocios.jrxml';   

        $jasper = new PHPJasper;
        $jasper->compile($input)->execute();

        return "ok";
    }

    public function ejecutarReporteNegocios(){

    
        $input =  base_path().'/vendor/geekcom/phpjasper-laravel/examples/ReporteNegocios.jasper';   
        $output =  base_path().'/vendor/geekcom/phpjasper-laravel/examples/';   

        $jdbc_dir = base_path(). '/vendor/geekcom/phpjasper-laravel/bin/jasperstarter/jdbc';

        $options = [
            'format'=> ['pdf', 'xls'],
            'db_connection' => [
                'driver' => 'generic',
                'host' => env('DB_HOST'),
                'port' => env('DB_PORT'),
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'jdbc_driver' => 'com.microsoft.sqlserver.jdbc.SQLServerDriver',
                'jdbc_url' => 'jdbc:sqlserver://'. env('DB_HOST'). ':'. env('DB_PORT'). ';databaseName=' . env('DB_DATABASE'),
                'jdbc_dir' => $jdbc_dir
            ]
        ];

    $jasper = new PHPJasper;

       $jasper->process(
            $input,
            $output,
            $options
        )->execute();

        return response()->file($output . 'ReporteNegocios.pdf');
    }
}
