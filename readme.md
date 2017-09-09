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
$api = new PYS\LolApi\Api(API_KEY);
```
### Summoner
There are several ways to get Summoner: by account id, summoner id or by name

```php
// You can get summoner in several ways by passing type in third argument
// Default version: summoner, you can ommit it
$summonerById = $api->summoner($region, $summonerId);
$summonerByAccount = $api->makeSummoner($region, $accountId, 'account');
$summonerByName = $api->summoner($region, $name, 'name');
```

For more information see [Summoner API reference](https://developer.riotgames.com/api-methods/#summoner-v3)

### Match List

Recent

```php
$matches = $api->matchList($region, $accountId);
```
Recent via Summoner

```php
$matches = $api->summoner($region, $summonerId)->recentMatches();
```

Using query (e.g. one last match)

```php
$matches = $api->matchList(
    $region,
    $accountId,
    [
        'beginIndex' => 0,
        'endIndex' => 1,
    ]
);
```

### Match
Match by Id

```php
$match = $api->match($region, $matchId);
```

Match within Tournament

```php
$match = $api->match($region, $matchId, $tournamentId);
```
For more information see [Match API reference](https://developer.riotgames.com/api-methods/#match-v3)

### Leagues

Leagues and Positions of summoner by Summoner Id

```php
$leaguesPositions = $api->leaguePosition($region, $summonerId);
```

Leagues and Positions of summoner via Summoner object

```php
$leaguesPositions = $api
    ->summoner($region, $summonerId)
    ->leaguesPositions();
```

Leagues by Summoner Id

```php
$leagues = $api->league($region, $summonerId);
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