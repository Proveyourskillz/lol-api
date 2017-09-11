<?php namespace PYS\LolApi\ApiRequest;

use PYS\LolApi\Exceptions\WrongRegion;

final class Region
{
    const BR = 'BR';
    const EUNE = 'EUNE';
    const EUW = 'EUW';
    const JP = 'JP';
    const KR = 'KR';
    const LAN = 'LAN';
    const LAS = 'LAS';
    const NA = 'NA';
    const OCE = 'OCE';
    const TR = 'TR';
    const RU = 'RU';
    const PBE = 'PBE';

    private const REGIONS = [
        self::BR,
        self::EUNE,
        self::EUW,
        self::JP,
        self::KR,
        self::LAN,
        self::LAS,
        self::NA,
        self::OCE,
        self::TR,
        self::RU,
        self::PBE,
    ];
    private const REGIONS_PLATFORMS = [
        self::BR => 'BR1',
        self::EUNE => 'EUN1',
        self::EUW => 'EUW1',
        self::JP => 'JP1',
        self::KR => 'KR',
        self::LAN => 'LA1',
        self::LAS => 'LA2',
        self::NA => 'NA1',
        self::OCE => 'OC1',
        self::TR => 'TR1',
        self::RU => 'RU',
        self::PBE => 'PBE1',
    ];
    private const PLATFORMS_ENDPOINTS = [
        'BR1' => 'br1.api.riotgames.com',
        'EUN1' => 'eun1.api.riotgames.com',
        'EUW1' => 'euw1.api.riotgames.com',
        'JP1' => 'jp1.api.riotgames.com',
        'KR' => 'kr.api.riotgames.com',
        'LA1' => 'la1.api.riotgames.com',
        'LA2' => 'la2.api.riotgames.com',
        'NA1' => 'na1.api.riotgames.com',
        'OC1' => 'oc1.api.riotgames.com',
        'TR1' => 'tr1.api.riotgames.com',
        'RU' => 'ru.api.riotgames.com',
        'PBE1' => 'pbe1.api.riotgames.com',
    ];

    /**
     * @var string
     */
    private $region;

    /**
     * Region constructor.
     *
     * @param string $region
     *
     * @throws WrongRegion
     */
    public function __construct(string $region)
    {
        if (!$this->checkRegion($region)) {
            throw new WrongRegion("The region $region doesn't exist in API");
        }
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    public function getPlatform(): string
    {
        return self::REGIONS_PLATFORMS[$this->region];
    }

    public function getPlatformEndpoint()
    {
        return self::PLATFORMS_ENDPOINTS[self::REGIONS_PLATFORMS[$this->region]];
    }

    private function checkRegion(string $region): bool
    {
        return in_array(strtoupper($region), self::REGIONS, true);
    }
}