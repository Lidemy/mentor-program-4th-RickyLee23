const request = require('request');

const options = {
  url: 'https://api.twitch.tv/kraken/games/top',
  headers: {
    'Client-ID': 'x65tvhvwf2qnuphs3qnf891wc7wcs5',
    accept: 'application/vnd.twitchtv.v5+json',
  },
};

function callback(error, response, body) {
  if (response.statusCode >= 200 && response.statusCode < 300) {
    const info = JSON.parse(body);
    const games = info.top;
    for (let i = 0; i < games.length; i += 1) {
      console.log(games[i].viewers, games[i].game.name);
    }
  }
}
request(options, callback);
