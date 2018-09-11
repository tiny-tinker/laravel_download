<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class WhitePaperDownloadController extends Controller {

    public function index() {
        $urls = $this->getWhitepaperUrls();
        return view('whitepaperDownload/index')->with('urls', $urls);
    }

    public function download($file) {
        return response()->download(storage_path('app/public/whitepaper/').$file);
    }

    private function getWhitepaperUrls() {
        $urls = [];

        $languages = [
            'Arabic'        => 'العربية',
            'Chinese'       => '中文',
            'English'       => 'English',
            'French'        => 'Français',
            'Gujarati'      => 'ગુજરાતી',
            'Hindi'         => 'हिंदी',
            'Indonesian'    => 'Bahasa Indonesia',
            'Italian'       => 'italiano',
            'Portugese'     => 'Português',
            'Russian'       => 'Pусский',
            'Ukranian'      => 'Українська',
            'Vietnamese'    => 'Tiếng Việt'
        ];

        $allFiles = Storage::disk('whitepaperRelease')->files('');

        foreach ($allFiles as $file) {
            $data = [];
            if(($pos = strpos($file, "-")) !== FALSE) {
                $lng = substr($file, $pos+2); 
                $lng = substr($lng, 0, strlen($lng)-4);
                $data['lng'] = $languages[$lng];
                $data['path'] = $file;
                $urls[] = $data;
            }
        }

        return $urls;
    }
}