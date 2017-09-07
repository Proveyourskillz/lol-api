<?php namespace Likewinter\LolApi\Mapper;

use Likewinter\LolApi\Models\CurrentLeaguePositionModel;
use Likewinter\LolApi\Models\LeaguePositionModel;
use Likewinter\LolApi\Models\ModelInterface;

class LeaguePositionMapper extends AbstractMapper
{
    protected $model = LeaguePositionModel::class;

    public function map($data): ModelInterface
    {
        $leaguePosition = new LeaguePositionModel;
        $leaguePosition->leaguesPlayed = $this->mapper->mapArray(
            $data,
            [],
            CurrentLeaguePositionModel::class
        );

        return $leaguePosition;
    }
}
