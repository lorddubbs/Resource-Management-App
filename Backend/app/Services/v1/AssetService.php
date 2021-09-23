<?php

namespace App\Services\v1;

use App\Models\Asset;
use App\Services\BaseService;
use DB;
use Illuminate\Support\Str;
use Exception;

class AssetService extends BaseService
{
    public function fetchAll()
    {
        try {
            $assets = Asset::latest()->get();
            if (! $assets) {
                return formatResponse(200, 'No Asset record found', true);
            } else {
                return formatResponse(200, 'Assets retrieved successfully', true, $assets);
            }
        } catch (Exception $e) {
            return formatResponse(fetchErrorCode($e), get_class($e).': '.$e->getMessage());
        }
    }

    public function fetchOne($slug)
    {
        try {
            $data = DB::table('assets')->where('slug', $slug);
            if ($data->exists()) {
                $asset = $data->get();

                return formatResponse(200, 'Asset retrieved successfully', true, $asset);
            } else {
                return formatResponse(404, 'Provided Asset not found', false);
            }
        } catch (Exception $e) {
            return formatResponse(fetchErrorCode($e), get_class($e).': '.$e->getMessage());
        }
    }

    public function create($data)
    {
        try {
            if (is_file($data['content'])) {
                $content = $this->uploadToCloud($data['content']);
                $data['content'] = $content;
            }
            
            if ($data['type'] === 'link') {
                $content = $this->validateUrl($data['content']);
                if($content === false) 
                return response()->json([
                    'errors' => ['content' => [
                        'Invalid Link'
                        ]]], 422);
            }

            $data['slug'] = Str::slug($data['title']);

            
            DB::transaction(function () use ($data, &$saveAsset) {
                $saveAsset = Asset::create($data);
            });

            return formatResponse(201, 'Asset Resource created successfully', true, $saveAsset);

        } catch (Exception $e) {
            return formatResponse(fetchErrorCode($e), get_class($e).': '.$e->getMessage());
        }

    }

    public function update($data, $id)
    {
        try {
            $asset = $this->getAsset($id);
            if (! $asset) {
                return formatResponse(404, 'Asset not found', false);
            } else {

                if (is_file($data['content'])) {
                    $content = $this->uploadToCloud($data['content']);
                    $data['content'] = $content;
                }
                
                if ($data['type'] === 'link') {
                    $content = $this->validateUrl($data['content']);
                    if($content === false) 
                    return response()->json([
                        'errors' => ['content' => [
                            'Invalid Link'
                            ]]], 422);
                }
                DB::transaction(function () use ($data, $asset) {
                    $updateAsset = $asset->update($data);
                });

                return formatResponse(200, 'Assets updated successfully', true, $asset);
            }

        } catch (Exception $e) {
            return formatResponse(fetchErrorCode($e), get_class($e).': '.$e->getMessage());
        }
    }

    public function delete($id, $data = null)
    {
        try {

            $asset = $this->getAsset($id);

            if (! $asset) {
                return formatResponse(404, 'Asset doesn\'t exist!', false);
            } else {
                DB::beginTransaction();
                    $asset->delete();
                DB::commit();

                return formatResponse(200, 'Asset deleted successfully', true);
            }
        } catch (Exception $e) {
            DB::rollback();

            return formatResponse(fetchErrorCode($e), get_class($e).': '.$e->getMessage());
        }
    }

    public function findAsset($id)
    {
        try {
            $data = DB::table('assets')->where('id', $id);
            if ($data->exists()) {
                $asset = $data->get();

                return formatResponse(200, 'Asset retrieved successfully', true, $asset);
            } else {
                return formatResponse(404, 'Provided Asset not found', false);
            }
        } catch (Exception $e) {
            return formatResponse(fetchErrorCode($e), get_class($e).': '.$e->getMessage());
        }
    }

    protected function uploadToCloud($pdf) {
        $file = $pdf;
        $upload = $file->storeOnCloudinary('Files');
        $file = $upload->getSecurePath();
        return $file;
    }

    protected function validateUrl($content) {
        if(filter_var($content, FILTER_VALIDATE_URL) === false)
          return false;
    }


    public function getAsset($id)
    {
        $asset = Asset::where(['id' => $id])->first();

        return $asset;
    }

    public function getAssetCounts() {
        try {
            //$assets =  Asset::whereIn('type', ['pdf', 'snippet', 'link'])->count();
            $assets =  DB::table('assets')->whereIn('type', ['pdf', 'snippet', 'link'])->get();
            $pdf = $assets->where('type','=','pdf')->count();
            $snippets = $assets->where('type','=','snippet')->count();
            $links = $assets->where('type','=','link')->count();
            
            return formatResponse(200, 'Counts retrieved successfully', true, [
                'pdfs' => $pdf,
                'snippets' => $snippets,
                'links' => $links
            ]);
        } catch (Exception $e) {
            return formatResponse(fetchErrorCode($e), get_class($e).': '.$e->getMessage());
        }
    }

    public function fetchMany($begin, $perPage, $sortBy, $sortDirection)
    {
        //
    }
}