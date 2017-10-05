<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $id = $request->input('id');
        $ID = $request->input('ID');        
        if(isset($id))
        {
            //Detect System and auto download.
            $file_url = 'SetupOmniBazaar-Windows.exe';
            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: Binary'); 
            if (isset($_GET['ID']))
            {
                header('Content-disposition: attachment; filename="SetupOmniBazaar-'.$_GET['ID'].'.exe"'); 
            }
            else if (isset($_GET['id']))
            {
                header('Content-disposition: attachment; filename="SetupOmniBazaar-'.$_GET['id'].'.exe"'); 
            }
            else 
            {
                header('Content-disposition: attachment; filename="SetupOmniBazaar.exe"'); 
            }
            ob_clean(); flush();
            readfile($file_url);
            return view('download/index');
        }
        else if(isset($ID)) 
        {
            //Detect System and auto download.
            $file_url = 'SetupOmniBazaar-Windows.exe';
            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: Binary'); 
            if (isset($_GET['ID']))
            {
                header('Content-disposition: attachment; filename="SetupOmniBazaar-'.$_GET['ID'].'.exe"'); 
            }
            else if (isset($_GET['id']))
            {
                header('Content-disposition: attachment; filename="SetupOmniBazaar-'.$_GET['id'].'.exe"'); 
            }
            else 
            {
                header('Content-disposition: attachment; filename="SetupOmniBazaar.exe"'); 
            }
            ob_clean(); flush();
            readfile($file_url);
            return view('download/index');
        }
        else
        {
            //Show download page
            return view('download/index');
        }
        
    }
}
