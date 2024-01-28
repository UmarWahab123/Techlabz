<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class BackupController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        
        $files = $disk->files(config('backup.backup.name'));

        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

        $data = [];
        $data['backups'] = $backups;

        return view('super_admin.manage_backup.index', $data);

    }

    public function takeBackup(Request $request)
    {
        if (!empty($_POST)) {
            
            \Artisan::call('backup:run');
            $output = \Artisan::output();

            return response()->json([
                    "success" => true,
                    'status'=>true,
                    'message'=>'',
                    'data'=>''
            ]);

        } else {
            $result = array(
                "success" => false,
                'status'=>false,
                'message'=>'Something went wrong!',
            );
        }
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
    }


}
