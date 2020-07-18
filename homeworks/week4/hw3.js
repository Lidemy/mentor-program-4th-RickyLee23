const request = require('request');

const process = require('process');

const countryName = process.argv[2];

request(`https://restcountries.eu/rest/v2/name/${countryName}`,
  (error, response, body) => {
    if (error) {
      console.log('Fail', error);
    }
    const info = JSON.parse(body);
    for (let i = 0; i < info.length; i += 1) {
      console.log('============');
      console.log(`國家 :' + ${info[i].name}`);
      console.log(`首都 :' + ${info[i].capital}`);
      console.log(`貨幣 :' + ${info[i].currencies[0].code}`);
      console.log(`國碼 :' + ${info[i].callingCodes[0]}`);
    }
  });
