<?php

namespace App\Http\Controllers;

use App\Models\Mountain;
use App\Models\MountainAble;
use App\Models\Regulation;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(){

        $regulations = Regulation::all();
        $mountains = Mountain::all();
        return view('landing',[
            'regulations'=>$regulations,
            'mountains'=>$mountains,
        ]);
      
        // $mountains = Mountain::all();
        // return view('landing', compact('mountains'));
    }
    
    private function getWeatherData($latitude, $longitude)
    {
        $apiKey = '2ecd37a1f5e9b94e2c371fa787d78bf4'; // Ganti dengan kunci API OpenWeatherMap Anda
        $client = new \GuzzleHttp\Client();
        $url = "https://api.openweathermap.org/data/2.5/weather?lat={$latitude}&lon={$longitude}&appid={$apiKey}";
    
        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);
            return $data;
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan saat mengambil data cuaca
            // Misalnya, tampilkan pesan kesalahan atau fallback ke data cuaca default
            return null;
        }
    }
    


    // public function show($mountain)
    // {
       
    //     $value = Mountain::find($mountain);
    //     $ables = MountainAble::where('mountain_id', $mountain)->get();
    //     // dd($ables);
    //     return view('detail',[
    //         'mountain'=>$value,
    //         'ables'=>$ables,
    //     ]);
        
    // }

    public function show($mountain)
    {
        $value = Mountain::find($mountain);
        $ables = MountainAble::where('mountain_id', $mountain)->get();
    
        $latitude = $value->latitude;
        $longitude = $value->longitude;
    
        $weatherData = $this->getWeatherData($latitude, $longitude);
    
        return view('detail', [
            'mountain' => $value,
            'ables' => $ables,
            'weatherData' => $weatherData,
        ]);
     
    }
    

    

    
    // public function regulation(){
    //     $regulations = Regulation::all();
    //     return view('listNews', compact('regulations'));
    // }
    
    public function regulation(){
        $search = request('search');
    
        $regulations = Regulation::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%$search%")
                         ->orWhere('content', 'LIKE', "%$search%");
        })->get();
    
        return view('listNews', compact('regulations'));
    }

    public function showregulation($regulation)
    {
        $value = Regulation::find($regulation);
        // dd($ables);
        return view('detailNews',[
            'regulation'=>$value,
        ]);
        
    }



}