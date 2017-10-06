<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes\BrowserDetection;

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

    public function index(Request $request)
    {
        $ID = $request->input('ID');        
        if(isset($ID)) 
        {
            //Detect System and auto download.
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

            // Donwload file
            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: Binary'); 
            if (isset($_GET['ID']))
            {
                header('Content-disposition: attachment; filename="SetupOmniBazaar-'.$_GET['ID'].$file_ext.'"'); 
            }
            else if (isset($_GET['id']))
            {
                header('Content-disposition: attachment; filename="SetupOmniBazaar-'.$_GET['id'].$file_ext.'"'); 
            }
            else 
            {
                header('Content-disposition: attachment; filename="SetupOmniBazaar'.$file_ext.'"'); 
            }
            ob_clean(); flush();
            readfile($file_url);
            return redirect()->route('download.index');
        }
        else
        {
            //Show download page
            return view('download/index');
        }
        
    }
}
