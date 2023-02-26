<?php

namespace App\Services\Search;
use Illuminate\Support\Str;

/**
 * Class FullTextSearchService
 * @property string $phrase
 * @package App\Services\Search
 * @author M.Alipuor <meysam.alipuor@gmail.com>
 */
class FullTextSearchService
{
    /**
     * @var string
     */
    private $phrase;

    /**
     * FullTextSearchService constructor.
     * @param string $phrase
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function __construct(string $phrase)
    {
        $this->phrase = $phrase;
    }


    public function prepareText($type)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $this->phrase);

        $words = explode(' ', $term);

        foreach($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if(Str::length($word) >= 2) {
                $words[$key] = $this->appendSymbols($word, $type);
            }
        }

        $searchTerm = implode( ' ', $words);
        return $searchTerm;
    }


    private function appendSymbols(string $value, $type)
    {
        if($type == 'or')
        {
            return "{$value}*";
        }
        else
        {
            return "+{$value}*";
        }
    }
}
