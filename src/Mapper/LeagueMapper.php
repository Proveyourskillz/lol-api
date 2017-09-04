<?php
/**
 * Created by PhpStorm.
 * User: pilot
 * Date: 8/31/17
 * Time: 2:21 PM
 */

namespace Likewinter\LolApi\Mapper;

use Likewinter\LolApi\Models\LeagueListModel;
use Likewinter\LolApi\Models\LeagueModel;
use Likewinter\LolApi\Models\ModelInterface;

class LeagueMapper extends AbstractMapper
{
    protected $model = LeagueModel::class;

    public function map($data): ModelInterface
    {
        $leagueModel = new LeagueModel;
        $leagueModel->leaguesPlayed = $this->mapper->mapArray(
            $data,
            [],
            LeagueListModel::class
        );

        return $leagueModel;
    }
}