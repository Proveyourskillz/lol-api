<?php
/**
 * Created by PhpStorm.
 * User: pilot
 * Date: 8/31/17
 * Time: 3:40 PM
 */

namespace Likewinter\LolApi\Models;

class LeagueListModel extends AbstractModel
{
    /**
     * @var string
     */
    public $tier;
    /**
     * @var string
     */
    public $queue;
    /**
     * @var string
     */
    public $name;
    /**
     * List of League items
     * @var LeagueItemModel[]
     */
    public $entries;
}