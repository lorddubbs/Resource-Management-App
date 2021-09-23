<?php

/**
 * @OA\Schema(
 *     title="Create Asset Request",
 *     description="Body Data | An Asset can be a PDF file, HTML Snippet or Link",
 *     type="object",
 *     required={"title", "description", "content", "type", "option"}
 * )
 */
class CreateAsset
{
    /**
     * @OA\Property(
     *      title="title",
     *      description="The title of the Asset",
     *      example="How I Met Your Mother"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="description",
     *      description="The description of the asset created",
     *      example="Comic relief"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="content",
     *      description="The content media of the Asset",
     *      example="https://en.wikipedia.org/wiki/How_I_Met_Your_Mother"
     * )
     *
     * @var string
     */
    public $content;

    /**
     * @OA\Property(
     *      title="type",
     *      description="The type of media for the Asset",
     *      example="link"
     * )
     *
     * @var string
     */
    public $type;

    /**
     * @OA\Property(
     *      title="option",
     *      description="The option specified for content",
     *      example=1
     * )
     *
     * @var string
     */
    public $option;

}
