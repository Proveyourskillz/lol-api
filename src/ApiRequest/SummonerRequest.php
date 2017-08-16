<?php namespace Likewinter\LolApi\ApiRequest;

use Likewinter\LolApi\Mapper\SummonerMapper;

class SummonerRequest extends AbstractRequest
{
    const CREDENTIAL_TYPES = ['account', 'name', 'summoner'];

    protected $mapperClass = SummonerMapper::class;

    protected $type = 'summoner';
    protected $version = 3;

    protected $credential;
    protected $value;

    /**
     * SummonerRequest constructor.
     *
     * @param string $credential
     * @param mixed $value
     * @param string $region
     */
    public function __construct(string $region, string $credential, $value)
    {
        $this->credential = static::validateCredential($credential);
        $this->value = $value;
        $this->region = $region;
    }

    public static function byAccountId(string $region, int $accountId)
    {
        return new static($region, 'account', $accountId);
    }

    public static function byName(string $region, string $name)
    {
        return new static($region, 'name', $name);
    }

    public static function bySummonerId(string $region, int $summonerId)
    {
        return new static($region, 'summoner', $summonerId);
    }

    public function getSubtypes(): array
    {
        $subtypes = [];

        switch ($this->credential) {
            case 'account':
                $subtypes = [
                    'summoners',
                    'by-account' => (int) $this->value
                ];
                break;
            case 'name':
                $subtypes = [
                    'summoners',
                    'by-name' => (string) $this->value
                ];
                break;
            case 'summoner':
                $subtypes = [
                    'summoners' => (int) $this->value
                ];
                break;
        }

        return $subtypes;
    }

    private static function validateCredential(string $credential)
    {
        if (!in_array($credential, static::CREDENTIAL_TYPES, true)) {
            throw new \InvalidArgumentException('The credential must be of type ' . implode(', ', static::CREDENTIAL_TYPES));
        }

        return $credential;
    }
}
