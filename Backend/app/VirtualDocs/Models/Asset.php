<?php

namespace App\VirtualDocs\Models;

/**
 * @OA\Schema(
 *     title="Asset",
 *     description="Asset model",
 *     @OA\Xml(
 *         name="Asset"
 *     )
 * )
 */
class Asset
{
  /**
   * @OA\Property(
   *     title="ID",
   *     description="ID",
   *     format="int64",
   *     example=1
   * )
   *
   * @var int
   */
  private $id;

  /**
   * @OA\Property(
   *      title="title",
   *      description="The title of the Asset",
   *      example="How I Met Your Mother",
   *      type="string"
   * )
   *
   * @var string
   */
  public $title;

  /**
   * @OA\Property(
   *      title="description",
   *      description="The description of the Asset",
   *      example="Robin later joined the Avengers",
   *      type="string"
   * )
   *
   * @var string
   */
  public $description;

  /**
   * @OA\Property(
   *      title="content",
   *      description="The content media of the Asset",
   *      example="https://res.cloudinary.com/dtgglytjm/image/upload/v1612307531/Files/i9gts5zn0wiusxekrrjz.pdf",
   *      type="string"
   * )
   *
   * @var string
   */
  public $content;

  /**
   * @OA\Property(
   *      title="type",
   *      description="The type of media for the Asset",
   *      example="file",
   *      type="string"
   * )
   *
   * @var string
   */
  public $type;

  /**
   * @OA\Property(
   *      title="option",
   *      description="The option specified for content",
   *      example="0",
   *      type="string"
   * )
   *
   * @var string
   */
  public $option;

  /**
   * @OA\Property(
   *     title="Created at",
   *     description="Created at",
   *     example="2021-09-27 17:50:45",
   *     format="datetime",
   *     type="string"
   * )
   *
   * @var \DateTime
   */
  private $created_at;

  /**
   * @OA\Property(
   *     title="Updated at",
   *     description="Updated at",
   *     example="2021-09-27 17:50:45",
   *     format="datetime",
   *     type="string"
   * )
   *
   * @var \DateTime
   */
  private $updated_at;


}
