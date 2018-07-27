<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\BrowserDetection;
use function PHPSTORM_META\type;
use Session;
use Illuminate\Support\Facades\Storage;

const DOWNLOAD_TYPE_WINDOWS = 0;
const DOWNLOAD_TYPE_LINUX = 1;
const DOWNLOAD_TYPE_MAC = 2;
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

    /**
     * @param type $
     */
    private function getLatestFileName($downloadType=DOWNLOAD_TYPE_WINDOWS)
    {
        // #1. Get all release file names
        $allFiles = Storage::disk('release')->files('');
        switch ($downloadType) {
            case DOWNLOAD_TYPE_WINDOWS:
                $pattern_match ='/^OmniBazaar.*exe$/';
                break;
            case DOWNLOAD_TYPE_LINUX:
                $pattern_match ='/^OmniBazaar.*deb$/';
                break;
            case DOWNLOAD_TYPE_MAC:
                $pattern_match ='/^OmniBazaar.*pkg$/';
                break;
            default:
                return -1;
        }
        $match_files = preg_grep($pattern_match, $allFiles);

        // #2. Extract versions
        $version_pattern = '/(\d+\.)(\d+\.)(\d+)/';
        $versions = [];
        $file_path = [];
        foreach ($match_files as $match_file) {
            $matches = [];
            preg_match ($version_pattern, $match_file, $matches);
            if ($matches !=null)
            {
                $versions[] = $matches[0];
                $file_path[] = $match_file;
            }
        }

        // #3. Get the latest version
        $latest_version = null;
        $latest_version_index = -1;
        if ($versions!= null) {
            $latest_version = $versions[0];
            foreach($versions as $key=>$version) {
                if ($latest_version < $version) {
                    $latest_version = $version;
                    $latest_version_index = $key;
                }
            }
        } else {
            return -1; // No matching download files
        }

        return $file_path[$latest_version_index];
    }

    private function checkRefAndDownload($request, $file_url, $file_ext) {
        $file_download_url = storage_path('app/public/releases/').$file_url;

        if ($request->session()->has('referrer_id'))
        {
            $referrer_id = $request->session()->get('referrer_id', null);
            $file_name = substr($file_url, 0, strlen($file_url)-4);
            $download_file_name = $file_name.'-'.$referrer_id.$file_ext;
            return response()->download($file_download_url, $download_file_name);
            //return Storage::disk('release')->download($file_url, $download_file_name);
            //return Storage::disk('release')->download($file_url);
        }
        else
        {
            return response()->download($file_download_url);
            //return Storage::disk('release')->download($file_url);
        }
    }
    public function downloadWindows(Request $request)
    {
        $file_url = $this->getLatestFileName(DOWNLOAD_TYPE_WINDOWS);;
        $file_ext = '.exe';
        return $this->checkRefAndDownload($request, $file_url, $file_ext);
    }

    public function downloadLinux(Request $request)
    {
        $file_url = $this->getLatestFileName(DOWNLOAD_TYPE_LINUX);;
        $file_ext = '.deb';

        return $this->checkRefAndDownload($request, $file_url, $file_ext);
    }

    public function downloadMac(Request $request)
    {
        $file_url = $this->getLatestFileName(DOWNLOAD_TYPE_MAC);;
        $file_ext = '.pkg';

        return $this->checkRefAndDownload($request, $file_url, $file_ext);
    }

    public function index(Request $request)
    {
        $ID = $request->input('ref');

        // If ID is set store the ID to the session
        if (isset($ID))
        {
            $request->session()->put('referrer_id', $ID);
        }

        return view('download/index');
    }
}