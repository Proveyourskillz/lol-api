<?php namespace Likewinter\LolApi\ApiRequest;

use Likewinter\LolApi\Mapper\MatchMapper;

class MatchRequest extends AbstractRequest
{
    protected $mapperClass = MatchMapper::class;

    protected $type = 'match';
    protected $version = 3;

    protected $matchId;

    /**
     * MatchRequest constructor.
     *
     * @param $matchId
     * @param $region
     */
    public function __construct(string $region, int $matchId)
    {
        $this->matchId = $matchId;
        $this->region = $region;
    }

    public function getSubtypes(): array
    {
        return [
            'matches' => $this->matchId
        ];
    }
}
