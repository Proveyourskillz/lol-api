# League of Legends PHP API wrapper

Dead simple wrapper of Riot Games API (LoL)

## Requirements
* PHP 7.1
* works better with ext-curl installed

## Installation

run `composer install` from clonned repository folder

## Usage

You can find examples of usage in `examples` dir

### Creating API instance
```php
$api = new Likewinter\LolApi\Api(API_KEY);
```
### Summoner
There are several ways to get Summoner: by account id, summoner id or by name

```php
$summoner = $api->makeSummoner(
    new SummonerRequest($region, $typeName, $typeValue)
);
// Or you can use static shorthand methods
$summonerById = $api->makeSummoner(
    SummonerRequest::bySummonerId($region, $summonerId)
);
$summonerByAccount = $api->makeSummoner(
    SummonerRequest::byAccountId($region, $accountId)
);
$summonerByName = $api->makeSummoner(
    SummonerRequest::byName($region, $name)
);
```

For more information see [Summoner API reference](https://developer.riotgames.com/api-methods/#summoner-v3)

### Match List

Recent match list

```php
$matches = $api->makeMatchList(
    new MatchListRequest($region, $accountId)
);
```

Using query (e.g. one last match)

```php
$matches = $api->makeMatchList(
    new MatchListRequest($region, $accountId, [
        'beginIndex' => 0,
        'endIndex' => 1,
    ]
);
```

Or using fluent setters

```php
$matches = $api->makeMatchList(
    (new MatchListRequest($region, $accountId))
        ->fromDate(new DateTime('-24 hours'))
        ->toDate(new DateTime('now'));
);
```

### Match
Match by Id

```php
$match = $api->makeMatch(
    new MatchRequest($region, $matchId)
);
```

Match within Tournament

```php
$match = $api->makeMatch(
    (new MatchRequest($region, $matchId))
        ->withinTournament($tournamentId)
);
```
For more information see [Match API reference](https://developer.riotgames.com/api-methods/#match-v3)

### Leagues

Leagues and Positions of summoner by Summoner Id

```php
$leaguesPositions = $api->makePositionLeague(
    new LeaguePositionRequest($region, $summonerId)
);
```

Leagues and Positions of summoner via Summoner object

```php
$summoner = $api->makeSummoner(
    SummonerRequest::bySummonerId($region, $summonerId)
);
$leaguesPositions = $summoner->leaguesPositions();
```

Leagues by Summoner Id

```php
$leagues = $api->makeLeague(
    new LeagueRequest($region, $summonerId)
);
```

## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## History

Alpha version

## Credits
- Anton Orlov <anton@proveyourskillz.com>
- Pavel Dudko <pavel@proveyourskillz.com>

## License

MIT 