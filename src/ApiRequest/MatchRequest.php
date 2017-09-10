<?php namespace PYS\LolApi\ApiRequest;

use PYS\LolApi\Mapper\MatchMapper;

class MatchRequest extends AbstractRequest
{
    protected static $mapperClass = MatchMapper::class;

    protected $type = 'match';
    protected $version = 3;

    protected $matchId;
    protected $tournamentId;

    /**
     * MatchRequest constructor.
     *
     * @param string $region
     * @param int $matchId
     * @param int|null $tournamentId
     */
    public function __construct(string $region, int $matchId, ?int $tournamentId = null)
    {
        $this->matchId = $matchId;
        $this->region = $region;
        $this->tournamentId = $tournamentId;
    }

    public function getSubtypes(): array
    {
        if ($this->tournamentId === null) {
            return [
                'matches' => $this->matchId,
            ];
        }

        return [
            'matches' => $this->matchId,
            'by-tournament-code' => $this->tournamentId,
        ];
    }

    public function withinTournament(int $tournamentId): self
    {
        $this->tournamentId = $tournamentId;

        return $this;
    }
}
