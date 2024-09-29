<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

    /**
     * @method total()
     * @method perPage()
     * @method currentPage()
     * @method lastPage()
     */
class GeneralCollection extends ResourceCollection
{
     protected mixed $resourceClass;

    public function __construct($resource, $resourceClass = null)
    {
        parent::__construct($resource);
        $this->resourceClass = $resourceClass;
    }

    public function toArray(Request $request): array
    {
        $resourceClass = $this->resourceClass;

        return [
            'data' => $resourceClass ? $this->collection->map(function($item) use ($resourceClass) {
                return new $resourceClass($item);
            }) : $this->collection,
            'pagination' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage()
            ],
        ];
    }

    public function withResponse($request, $response): void
    {
        $jsonResponse = json_decode($response->getContent(), true);
        unset($jsonResponse['links'], $jsonResponse['meta']);
        $response->setContent(json_encode($jsonResponse));
    }
}
