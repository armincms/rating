<?php

namespace Armincms\Rating;


trait Rateable
{ 
    use \willvincent\Rateable\Rateable;

    /**
     * Order given query by the sum rating.
     * 
     * @param  \Illuminate\Database\Eloqeunt\Builder $query
     * @param  string $direction
     * @return \Illuminate\Database\Eloqeunt\Builder       
     */
    public function scopeOrderByRating($query, string $direction = 'asc')
    {    
        if (is_null($query->getQuery()->columns)) {
            $query->select([$query->qualifyColumn('*')]);
        }

        return $query->selectSub($this->ratingQuery(), 'rating')->orderBy('rating', $direction);
    }

    /**
     * Returns query for the rating sum.
     * 
     * @return \Illuminate\Database\Eloqeunt\Builder   
     */
    public function ratingQuery()
    {
        return $this->ratings()->getModel()->selectRaw('sum(rating)')
                    ->whereRateableType($this->getMorphClass()) 
                    ->whereColumn('rateable_id', $this->getQualifiedKeyName())
                    ->getQuery(); 
    }

    /**
     * Order given query descnding by the sum rating.
     * 
     * @param  \Illuminate\Database\Eloqeunt\Builder $query
     * @return \Illuminate\Database\Eloqeunt\Builder       
     */
    public function scopeOrderByRatingDesc($query)
    {  
        return $query->orderByRating('desc');
    }
}