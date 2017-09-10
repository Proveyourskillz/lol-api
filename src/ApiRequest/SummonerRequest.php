<?php namespace PYS\LolApi\ApiRequest;

use PYS\LolApi\Mapper\SummonerMapper;

class SummonerRequest extends AbstractRequest
{
    const CREDENTIAL_TYPES = ['account', 'name', 'summoner'];

    protected static $mapperClass = SummonerMapper::class;

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
    public function __construct(string $region, $value, string $credential = 'summoner')
    {
        $this->credential = static::validateCredential($credential);
        $this->value = $value;
        $this->region = $region;
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
