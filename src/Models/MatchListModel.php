<?php namespace Likewinter\LolApi\Models;

use Likewinter\LolApi\ApiRequest\MatchRequest;

class MatchListModel extends AbstractModel
{
    /**
     * @var MatchReferenceModel[]
     */
    public $matches;
    /**
     * @var int
     */
    public $totalGames;
    /**
     * @var int
     */
    public $startIndex;
    /**
     * @var int
     */
    public $endIndex;

    public function getMatchRequest(MatchReferenceModel $matchReferenceModel): MatchRequest
    {
        return new MatchRequest($matchReferenceModel->gameId, $this->region);
    }

    public function match(MatchReferenceModel $matchReferenceModel): MatchModel
    {
        return $this->getApi()->request($this->getMatchRequest($matchReferenceModel));
    }

    public function matchByNumber(int $number): MatchModel
    {
        return $this
            ->getApi()
            ->request(
                $this->getMatchRequest(
                    $this->matches[$number]
                )
            );
    }
}
