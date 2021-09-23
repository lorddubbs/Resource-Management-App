<?php

namespace Tests\Unit;

use App\Models\Asset;
use App\Services\v1\AssetService;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssetServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $assetService;
    protected $asset;

    public function setup(): void
    {
        parent::setup();

        //asset setup
        $this->asset = Asset::create([
            'title' => 'Twitter Ethics',
            'slug' => Str::slug('Twitter Ethics'),
            'description' => 'A twitter handbook',
            'content' => 'http://twitter.com/terms-and-conditions',
            'type' => 'link',
            'option' => '1'
        ]);

        $this->assetService = new AssetService();
    }

    public function testGetAllAssets()
    {
        $result = $this->assetService->fetchAll();
        $this->assertNotEmpty($result);
    }

    public function testGetASingleAsset()
    {
        $result = $this->assetService->findAsset(1);
        $this->assertNotEmpty($result);
    }

    public function testCreateAsset()
    {
        $assetData = [
            'title' => 'Twitter Ethics',
            'slug' => Str::slug('Twitter Ethics'),
            'description' => 'A twitter handbook',
            'content' => 'http://twitter.com/terms-and-conditions',
            'address' => 'Address 1',
            'type' => 'link',
            'option' => '1'
        ];

        $result = $this->assetService->create($assetData);
        $this->assertNotEmpty($result);
    }

    public function testDeleteAsset()
    {
        $assetData = [];
        $result = $this->assetService->delete(1, $assetData);
        $this->assertNotEmpty($result);
    }

    public function testGetAssetCounts()
    {
        $result = $this->assetService->getAssetCounts();
        $this->assertNotEmpty($result);
    }
    
}
