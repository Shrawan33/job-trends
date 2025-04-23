<?php

namespace Perception\Libraries\Meilisearch\Php;
use MeiliSearch\Search\SearchResult as MeilisearchPhp;

class SearchResult extends MeilisearchPhp
{
    /**
     * @var array<int, array<string, mixed>>
     */
    private $hits;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $limit;

    /**
     * `nbHits` is the attributes returned by the MeiliSearch server
     * and its value will not be modified by the methods in this class.
     * Please, use `hitsCount` if you want to know the real size of the `hits` array at any time.
     *
     * @var int
     */
    private $nbHits;

    /**
     * @var int
     */
    private $hitsCount;

    /**
     * @var bool
     */
    private $exhaustiveNbHits;

    /**
     * @var int
     */
    private $processingTimeMs;

    /**
     * @var string
     */
    private $query;

    /**
     * @var bool|null
     */
    private $exhaustiveFacetsCount;

    /**
     * @var array<string, mixed>
     */
    private $facetsDistribution;

    /**
     * @var array<string, mixed>
     */
    private $raw;

    public function __construct(array $body)
    {
        $this->hits = $body['hits'] ?? [];
        $this->offset = $body['offset'];
        $this->limit = $body['limit'];

        $this->hitsCount = \count($body['hits']);
        $this->exhaustiveNbHits = $body['exhaustiveNbHits'] ?? false;
        $this->processingTimeMs = $body['processingTimeMs'];
        $this->query = $body['query'];
        $this->exhaustiveFacetsCount = $body['exhaustiveFacetsCount'] ?? null;
        $this->facetsDistribution = $body['facetsDistribution'] ?? [];
        $this->raw = $body;
    }
}


?>
