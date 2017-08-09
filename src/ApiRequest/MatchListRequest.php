<?php namespace Likewinter\LolApi\ApiRequest;

use Likewinter\LolApi\Mapper\MatchListMapper;

class MatchListRequest extends AbstractRequest
{
    use QueryParamsTrait;

    protected static $queryParams = [
        'queue',
        'beginTime',
        'endIndex',
        'season',
        'champion',
        'beginIndex',
        'endTime',
    ];

    protected $type = 'match';
    protected $version = 3;

    protected $accountId;

    /**
     * MatchListRequest constructor.
     *
     * @param int $accountId
     * @param array $query
     * @param string $region
     */
    public function __construct(int $accountId, array $query = [], string $region = null)
    {
        $this->accountId = $accountId;
        $this->region = $region;
        $this->mapper = new MatchListMapper();
        $this->setQuery($query);
    }

    public function getSubtypes(): array
    {
        if (empty($this->query)) {
            return [
                'matchlists/by-account' => $this->accountId,
                'recent',
            ];
        }

        return ['matchlists/by-account' => $this->accountId];
    }

    public function fromDate(\DateTime $dateTime): self
    {
        $this->query['beginTime'] = $dateTime->getTimestamp() * 1000;

        return $this;
    }

    public function toDate(\DateTime $dateTime): self
    {
        $this->query['endTime'] = $dateTime->getTimestamp() * 1000;

        return $this;
    }

    public function lastMatches(int $number): self
    {
        $this->query['beginIndex'] = 0;
        $this->query['endIndex'] = $number;

        return $this;
    }

    public function matchRange(int $start, int $end): self
    {
        $this->query['beginIndex'] = $start;
        $this->query['endIndex'] = $end;

        return $this;
    }
}
