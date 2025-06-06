<?php

namespace App\Http\Controllers;

use App\Model\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Upload extends Controller
{
    /**
     * upload function to bring the path after uploading the file
     * Because the method parameters is going larger(longer) as 
     * ($request, $path, $upload_type='single', $delete_file = null, $new_name = null, $crud_type = []) 
     * we will replace it to array called $data
     * @return void
     */
    public static function upload($data = [])
    {
        if (in_array('new_name', $data)) {
            $new_name = $data['new_name'] === null ? time() : $data['new_name'];
        }
        if (request()->hasFile($data['file']) && $data['upload_type'] == 'single') {        
            Storage::has($data['delete_file']) ? Storage::delete($data['delete_file']) : '';
            return request()->file($data['file'])->store($data['path']);
        } elseif (request()->hasFile($data['file']) && $data['upload_type'] == 'files') {
            $file = request()->file($data['file']); // Fetch all image attributes (name, size, mime_type, path, ....)
            $orginalName = $file->getClientOriginalName();  // get image name before upload
            $size = $file->getSize();                       // get image size
            $mime_type = $file->getMimeType();              // get image mimetype
            $hashName = $file->hashName();                  // get image hash name after upload
            $file->store($data['path']);                    // Store the image
            $add = File::create([                                  // Store all image information inside files Table 
                'name'          => $orginalName,
                'size'          => $size,
                'file'          => $hashName,
                'path'          => $data['path'],
                'full_file'     => $data['path'] . '/' . $hashName,       // get full image path
                'mime_type'     => $mime_type,
                'file_type'     => $data['file_type'],              // used to refer that this image is back to the product image
                'relation_id'   => $data['relation_id']             // use to refer to product image id
            ]);
            return $add->id;
        }
    }

    public function delete($id)
    {
        $file = File::find($id);
        if (!empty($file)) {
            Storage::delete($file->full_file);  // delete the image from the storage folder
            $file->delete();                    // delete the image from database
        }
    }


	public function delete_files($product_id) {
		$files = File::where('file_type', 'product')->where('relation_id', $product_id)->get();
		if (count($files) > 0) {
			foreach ($files as $file) {
				$this->delete($file->id);
				Storage::deleteDirectory($file->path);      // This will delete the folder for every image
			}

		}
	}
}
