<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $this->middleware('auth');
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
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: Binary'); 
        $file_url = 'SetupOmniBazaar-Windows.exe';
        $file_ext = '.exe';

        if ($request->session()->has('referrer_id'))
        {
            $referrerid = $request->session()->get('referrer_id', null);
            header('Content-disposition: attachment; filename="SetupOmniBazaar-'.$referrerid.$file_ext.'"'); 
        }
        else 
        {
            header('Content-disposition: attachment; filename="SetupOmniBazaar'.$file_ext.'"'); 
        }
        ob_clean(); flush();
        readfile($file_url);
    }

    public function index(Request $request)
    {
        $ID = $request->input('ID');
        if ($request->session()->has('referrer_id'))
            $request->session()->forget('referrer_id');
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
        
    }
}
