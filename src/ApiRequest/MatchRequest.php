<?php namespace Likewinter\LolApi\ApiRequest;

use Likewinter\LolApi\Mapper\MatchMapper;

class MatchRequest extends AbstractRequest
{
    protected $mapperClass = MatchMapper::class;

    protected $type = 'match';
    protected $version = 3;

    protected $matchId;
    protected $tournamentId;

    /**
     * MatchRequest constructor.
     *
     * @param $matchId
     * @param $region
     */
    public function __construct(string $region, int $matchId, int $tournamentId)
    {
        $this->matchId = $matchId;
        $this->region = $region;
        $this->tournamentId = $tournamentId;
    }

    public static function byMatchId(string $region, int $matchId)
    {
        return new static($region, $matchId, 0);
    }

    public static function byTournamentCodeMatchId(string $region, int $matchId, int $tournamentId)
    {
        return new static($region, $matchId, $tournamentId);
    }

    public function getSubtypes(): array
    {
        if($this->tournamentId === 0){
            return [
                'matches' => $this->matchId
            ];
        } elseif($this->matchId!=0) {
            return [
                'matches/'.(string)$this->matchId.'/by-tournament-code' => $this->tournamentId
            ];
        }

    }
}
