<?php namespace Likewinter\LolApi\Mapper;

use Likewinter\LolApi\Models\LeagueListModel;
use Likewinter\LolApi\Models\LeagueModel;
use Likewinter\LolApi\Models\ModelInterface;

class LeagueMapper extends AbstractMapper
{
    protected $model = LeagueModel::class;

    public function map($data): ModelInterface
    {
        $leagueModel = new LeagueModel;
        $leagueModel->leagueList = $this->mapper->mapArray(
            $data,
            [],
            LeagueListModel::class
        );

        return $leagueModel;
    }
}
