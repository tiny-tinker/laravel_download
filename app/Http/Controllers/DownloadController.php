<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\BrowserDetection;
use Session;

class DownloadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function downloadWindows(Request $request)
    {
        //Detect System and auto download.
        
        /*            
        $browser = new BrowserDetection();
        $file_url = 'SetupOmniBazaar-Windows.exe';
        $file_ext = '.exe';
        if($browser->getPlatform() == BrowserDetection::PLATFORM_WINDOWS) {
            $file_url = 'SetupOmniBazaar-Windows.exe';
            $file_ext = '.exe';
        }
        else if ($browser->getPlatform() == BrowserDetection::PLATFORM_LINUX) {
            $file_url = 'SetupOmniBazaar-Linux';
        }
        else if ($browser->getPlatform() == BrowserDetection::PLATFORM_MACINTOSH) {
            $file_url = 'SetupOmniBazaar-Mac.dmg';
        }
        */
        // Donwload file
        //$file_url = url('/').'/download/SetupOmniBazaar-Windows.exe';        
        $file_url = public_path().'/download/SetupOmniBazaar-Windows.exe';
        //echo $file_url;
        //return;

        //header('Content-Type: application/octet-stream');
        //header('Content-Transfer-Encoding: Binary'); 
        $file_ext = '.exe';

        if ($request->session()->has('referrer_id'))
        {
            $referrerid = $request->session()->get('referrer_id', null);
            $filename = 'SetupOmniBazaar-'.$referrerid.$file_ext;
            return response()->download($file_url, $filename);
            //header('Content-disposition: attachment; filename="SetupOmniBazaar-'.$referrerid.$file_ext.'"'); 
        }
        else 
        {
            //header('Content-disposition: attachment; filename="SetupOmniBazaar'.$file_ext.'"'); 
            return response()->download($file_url);
        }
        //ob_clean(); flush();
        //readfile($file_url);
    }

    public function index(Request $request)
    {
        $ID = $request->input('ID');

        // If ID is set store the ID to the session
        if (isset($ID))
        {
            $request->session()->put('referrer_id', $ID);
        }

        if (Auth::check())
        {
            //Show download page
            return view('download/index');
        }
        else {
            return redirect('/login');
        }

        /*
        if(isset($ID)) 
        {
            $request->session()->put('referrer_id', $ID);
            //Show download page
            return view('download/index');            
        }
        else
        {
            //Show download page
            return view('download/index');
        }
        */
    }
}
