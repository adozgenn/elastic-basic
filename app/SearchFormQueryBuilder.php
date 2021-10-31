<?php

namespace App;

use ElasticScoutDriverPlus\Builders\QueryBuilderInterface;

final class SearchFormQueryBuilder implements QueryBuilderInterface
{
    /**
     * @var string
     */
    private $name;

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function buildQuery(): array
    {
        return [
            'match' => [
                'name' => [
                    'query' => $this->name,
                    'fuzziness' => 'auto'
                ]
            ]
        ];
    }
}
