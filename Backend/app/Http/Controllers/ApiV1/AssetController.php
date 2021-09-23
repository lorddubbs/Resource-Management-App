<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Http\Requests\{CreateAsset, UpdateAsset};
use App\Services\v1\AssetService;



class AssetController extends Controller
{
    protected $asset;

    public function __construct(AssetService $assetService)
    {
        $this->asset = $assetService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/asset",
     *      operationId="assetIndex",
     *      tags={"Assets"},
     *      summary="Authority: All | Get all Asset",
     *      description="This endpoint retrieves all assets",
     *      @OA\Response(
     *          response=200,
     *          description="Assets retrieved",
     *          @OA\JsonContent(ref="#/components/schemas/Asset")
     *       )
     *    )
     */
    public function index() 
    {
        return $this->asset->fetchAll();
    }

   /**
     * @OA\Post(
     *      path="/asset",
     *      operationId="createAsset",
     *      tags={"Assets"},
     *      summary="Authority: Administrator | Create a new Asset",
     *      description="This endpoint creates a new Asset, an Asset can be a PDF file, HTML Snippet or Link.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateAsset")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Asset created successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Asset")
     *      ),
     *      @OA\Response(
     *          response="403",
     *          description="Unauthorized. User not with access role",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="The given data was invalid.",
     *      ),
     *    )
     *
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateAsset  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAsset $request)
    {
        return $this->asset->create($request->validated());
    }


    /**
     * @OA\Put(
     *      path="/asset/{assetId}",
     *      operationId="updateAsset",
     *      tags={"Assets"},
     *      summary="Authority: Administrator | Update an Asset | Please use x-www-form-urlencoded for body",
     *      description="This endpoint updates the asset",
     *      @OA\Parameter(
     *        name="assetId",
     *        description="Asset ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *            type="integer"
     *        )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateAsset")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Asset updated",
     *          @OA\JsonContent(ref="#/components/schemas/Asset")
     *      ),
     *      @OA\Response(
     *          response="403",
     *          description="Unauthorized. User not with access role",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Asset not found",
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="The given data was invalid.",
     *      ),
     *    )
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateAsset  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAsset $request, int $id)
    {
        return $this->asset->update($request->validated(), $id);
    }

    /**
     * @OA\Get(
     *     path="/asset/{slug}",
     *     operationId="getAsset",
     *     tags={"Assets"},
     *     summary="Authority: Any | Get details of an Asset",
     *     description="This endpoint returns all related data of specified asset",
     *     @OA\Response(
     *        response=200,
     *        description="Asset retrieved successfully",
     *        @OA\JsonContent(ref="#/components/schemas/Asset")
     *     ),
     *     @OA\Response(response="401", description="Unauthenticated. Token needed"),
     *     @OA\Response(response="403", description="Unauthorized. User not with access role"),
     *     @OA\Response(response="404", description="Resource not found")
     * )
     */
    public function show($slug)
    {
        return $this->asset->fetchOne($slug);
    }

    /**
     * @OA\Get(
     *     path="/asset/find/{assetId}",
     *     operationId="findAsset",
     *     tags={"Assets"},
     *     summary="Authority: Administrator | Get details of an Asset by ID",
     *     description="This endpoint returns all related data of specified asset",
     *     @OA\Response(
     *        response=200,
     *        description="Asset retrieved successfully",
     *        @OA\JsonContent(ref="#/components/schemas/Asset")
     *     ),
     *     @OA\Response(response="401", description="Unauthenticated. Token needed"),
     *     @OA\Response(response="403", description="Unauthorized. User not with access role"),
     *     @OA\Response(response="404", description="Resource not found")
     * )
     */
    public function getAsset($id) {
        return $this->asset->findAsset($id);
    }

    /**
     * @OA\Delete(
     *     path="/asset/{assetId}",
     *     operationId="deleteAsset",
     *     tags={"Assets"},
     *     summary="Authority: Administrator | Delete an Asset",
     *     description="This endpoint deletes the selected Asset",
     *     @OA\Parameter(
     *        name="assetId",
     *        description="Asset ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *            type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Asset deleted successfully",
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Unauthorized. User not with access role",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Asset not found",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="The given data was invalid.",
     *     ),
     *  )
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\DeleteAsset  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return $this->asset->delete($id);
    }

    /**
     * @OA\Get(
     *      path="/asset/count",
     *      operationId="assetCounts",
     *      tags={"Assets"},
     *      summary="Authority: Administrator | Get all Asset Counts",
     *      description="This endpoint returns a count of resources created by type",
     *      @OA\Response(
     *          response=200,
     *          description="Asset Counts returned",
     *          @OA\JsonContent(ref="#/components/schemas/Asset")
     *       )
     *    )
     */
    public function getAssetCounts() {
        return $this->asset->getAssetCounts();
    }
}
