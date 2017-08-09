<?php namespace Likewinter\LolApi\Models;

use Likewinter\LolApi\ApiRequest\MatchListRequest;

class SummonerModel extends AbstractModel
{
    /**
     * ID of the summoner icon associated with the summoner
     * @var int
     */
    public $profileIconId;
    /**
     * SummonerRequest name
     * @var string
     */
    public $name;
    /**
     * SummonerRequest level associated with the summoner
     * @var int
     */
    public $summonerLevel;
    /**
     * Date summoner was last modified specified as epoch milliseconds. The following events will update this timestamp: profile icon change, playing the tutorial or advanced tutorial, finishing a game, summoner name change
     * @var \DateTime
     */
    public $revisionDate;
    /**
     * SummonerRequest ID
     * @var int
     */
    public $id;
    /**
     * Account ID
     * @var int
     */
    public $accountId;

    public function setRevisionDate(int $revisionDate): void
    {
        $this->revisionDate = (new \DateTime())->setTimestamp($revisionDate / 1000);
    }

    public function getMatchListRequest(): MatchListRequest
    {
        return new MatchListRequest($this->accountId, [], $this->region);
    }

    public function recentMatches(): MatchListModel
    {
        return $this->getApi()->request($this->getMatchListRequest());
    }
}
