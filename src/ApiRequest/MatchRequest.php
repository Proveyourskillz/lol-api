<?php namespace Likewinter\LolApi\ApiRequest;

use Likewinter\LolApi\Mapper\MatchMapper;

class MatchRequest extends AbstractRequest
{
    protected $type = 'match';
    protected $version = 3;

    protected $matchId;

    /**
     * MatchRequest constructor.
     *
     * @param $matchId
     * @param $region
     */
    public function __construct(int $matchId, string $region)
    {
        $this->matchId = $matchId;
        $this->region = $region;
        $this->mapper = new MatchMapper();
    }

    public function getSubtypes(): array
    {
        return [
            'matches' => $this->matchId
        ];
    }
}
