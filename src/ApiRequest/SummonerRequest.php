<?php namespace Likewinter\LolApi\ApiRequest;

use Likewinter\LolApi\Mapper\SummonerMapper;

class SummonerRequest extends AbstractRequest
{
    const CREDENTIAL_TYPES = ['account', 'name', 'summoner'];

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
    public function __construct(string $credential, $value, string $region)
    {
        $this->credential = static::validateCredential($credential);
        $this->value = $value;
        $this->region = $region;
        $this->mapper = new SummonerMapper();
    }

    public static function byAccountId(int $accountId, string $region)
    {
        return new static('account', $accountId, $region);
    }

    public static function byName(string $name, string $region)
    {
        return new static('name', $name, $region);
    }

    public static function bySummonerId(int $summonerId, string $region)
    {
        return new static('summoner', $summonerId, $region);
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
            throw \Exception('The credential must be of type ' . implode(', ', static::CREDENTIAL_TYPES));
        }

        return $credential;
    }
}
