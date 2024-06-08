<?php
namespace Frs\LaravelMassCrudGenerator\Utils;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Helper
{
    public static function getMetaData(LengthAwarePaginator $paginator): array
    {
        $pagination = [
            'total' => $paginator->total(),
            'count' => $paginator->count(),
            'per_page' => $paginator->perPage(),
            'current_page' => $paginator->currentPage(),
            'total_pages' => $paginator->lastPage()
        ];

        $links = [
            'self' => $paginator->url($paginator->currentPage()),
            'first' => $paginator->url(1),
            'prev' => $paginator->previousPageUrl(),
            'next' => $paginator->nextPageUrl(),
            'last' => $paginator->url($paginator->lastPage())
        ];

        return compact('pagination', 'links');
    }


}
                                                    
                                                            
                     
                                            
            
            