const request = require('request');

request('https://lidemy-book-store.herokuapp.com/books?_limit=10',
  (error, response, body) => {
    if (error) {
      console.log('Fail', error);
    }
    const tenBook = JSON.parse(body); // 將json格式轉為javascript物件，供瀏覽器使用
    for (let i = 0; i < tenBook.length; i += 1) {
      console.log(`${tenBook[i].id} ${tenBook[i].name}`);
    }
  });
