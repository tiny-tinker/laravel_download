<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

const DOWNLOAD_TYPE_WINDOWS = 0;
const DOWNLOAD_TYPE_LINUX = 1;
const DOWNLOAD_TYPE_MAC = 2;

class PublisherDownloadController extends Controller
{

    private function getLatestFileName($downloadType=DOWNLOAD_TYPE_WINDOWS) {
        // #1. Get all publisher releases
        $allFiles = Storage::disk('publishRelease')->files('');
        switch ($downloadType) {
            case DOWNLOAD_TYPE_WINDOWS:
                $pattern_match = '/win{1}/';
                break;
            case DOWNLOAD_TYPE_LINUX:
                $pattern_match = '/ubuntu{1}/';
                break;
            case DOWNLOAD_TYPE_MAC:
                $pattern_match = '/macos{1}/';
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
            preg_match($version_pattern, $match_file, $matches);
            if ($matches != null) {
                $versions[] = $matches[0];
                $file_path[] = $match_file;
            }
        }
        if (sizeof($versions) <=0) {
            return -1;
        }
        // #3. Get the latest version
        $latest_version = null;
        $latest_version_index = 0;
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

    public function index()
    {
        return view('publisherDownload/index');
    }

    public function downloadLinux() {
        $file_url = $this->getLatestFileName(DOWNLOAD_TYPE_LINUX);
        if ($file_url != -1) {
            $download_url = storage_path('app/public/publisher/').$file_url;
            return response()->download($download_url);
        }
    }

    public function downloadWindows() {
        $file_url = $this->getLatestFileName(DOWNLOAD_TYPE_WINDOWS);
        if ($file_url != -1) {
            $download_url = storage_path('app/public/publisher/').$file_url;
            return response()->download($download_url);
        }
    }

    public function downloadMac() {
        $file_url = $this->getLatestFileName(DOWNLOAD_TYPE_MAC);
        if ($file_url != -1) {
            $download_url = storage_path('app/public/publisher/').$file_url;
            return response()->download($download_url);
        }
    }
}
