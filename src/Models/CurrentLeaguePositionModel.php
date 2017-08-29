<?php
/**
 * Created by PhpStorm.
 * User: pilot
 * Date: 8/23/17
 * Time: 11:19 PM
 */

namespace Likewinter\LolApi\Models;


class CurrentLeaguePositionModel extends AbstractModel
{

    /**
     * @var string
     */
    public $queueType;
    /**
     * @var bool
     */
    public $hotStreak;
    /**
     * @var int
     */
    public $wins;
    /**
     * @var bool
     */
    public $veteran;
    /**
     * @var int
     */
    public $losses;
    /**
     * @var string
     */
    public $playerOrTeamId;
    /**
     * @var string
     */
    public $tier;
    /**
     * @var string
     */
    public $playerOrTeamName;
    /**
     * @var bool
     */
    public $inactive;
    /**
     * @var string
     */
    public $rank;
    /**
     * @var bool
     */
    public $freshBlood;
    /**
     * @var string
     */
    public $leagueName;
    /**
     * @var int
     */
    public $leaguePoints;

}