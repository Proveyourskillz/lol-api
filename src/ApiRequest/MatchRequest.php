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
     * @param string|Region $region
     * @param int $matchId
     * @param int|null $tournamentId
     *
     * @throws \PYS\LolApi\Exceptions\WrongRegion
     */
    public function __construct($region, int $matchId, ?int $tournamentId = null)
    {
        parent::__construct($region);

        $this->matchId = $matchId;
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
