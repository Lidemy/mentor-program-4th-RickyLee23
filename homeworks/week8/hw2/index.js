function getStreams(GamesName) { // function getStreams 用來取得被選取到的遊戲中，前20名的直播資訊
  const topStreamsRequest = new XMLHttpRequest();
  topStreamsRequest.open('GET', `https://api.twitch.tv/kraken/streams/?game=${GamesName}`, true);
  topStreamsRequest.setRequestHeader('Client-ID', 'x65tvhvwf2qnuphs3qnf891wc7wcs5');
  topStreamsRequest.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');
  topStreamsRequest.onload = function () {
    if (topStreamsRequest.status >= 200 && topStreamsRequest.status < 400) {
      try {
        console.log(JSON.parse(topStreamsRequest.responseText));
      } catch (err) {
        alert('error');
        console.log(err);
        return;
      }
      const streamsInfo = JSON.parse(topStreamsRequest.responseText).streams;
      document.querySelector('.live').innerHTML = ''; // function getStreams 每次被呼叫，先清空原有遊戲資訊
      for (let i = 0; i < 20; i += 1) {
        const item = document.createElement('div');
        item.innerHTML = `
      <div class = 'live__frame'>
        <div class = 'live__stream'><img src=${streamsInfo[i].preview.medium}></div>
        <div class = 'live__disc'>
          <div class = 'player__head'><img src=${streamsInfo[i].channel.logo}></div>
          <div class = 'player__disc'>
            <div class = 'player__title'>${streamsInfo[i].channel.status}</div>
            <div class = 'player__name'>${streamsInfo[i].channel.name}</div>
          </div>
        </div>
      </div>`;
        document.querySelector('.live').appendChild(item);
      }
      const blankBlock = document.createElement('div'); // 插入一個空的遊戲資訊，讓介面排列起來好看！
      blankBlock.innerHTML = `
  <div class = 'live__frame__blank'>
  </div>
  `;
      document.querySelector('.live').appendChild(blankBlock);
    }
  };
  topStreamsRequest.send();
}

function getTopGames() {
  const topNameRequest = new XMLHttpRequest(); // 建立 request，向伺服器索取流量前xx名的遊戲
  topNameRequest.open('GET', 'https://api.twitch.tv/kraken/games/top', true);
  topNameRequest.setRequestHeader('Client-ID', 'x65tvhvwf2qnuphs3qnf891wc7wcs5');
  topNameRequest.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');
  topNameRequest.onload = function () {
    if (topNameRequest.status >= 200 && topNameRequest.status < 400) {
      try { // try 是否有錯誤，有的話傳入 catch，請問醬子可以嗎，助教！
        console.log(JSON.parse(topNameRequest.responseText));
      } catch (err) {
        alert('error');
        console.log(err);
        return;
      }
      for (let i = 0; i < 5; i += 1) { // 收到 response 後，索取前五名的遊戲資料做處理
        const topGames = JSON.parse(topNameRequest.response).top[i].game.name;
        const item = document.createElement('div'); // 建立 div 的 item ，用來放置 html
        item.classList.add('btn'); // 多加個class = 'btn' ， 供點選前五名遊戲時判讀，避免取到上層的元素
        item.innerHTML = `${topGames}`; // 在 navigation bar (頁面右上角)，置入前幾名遊戲的名字
        document.querySelector('.navigator__items div').appendChild(item);
      }
      // 預先設定：將流量第一名的資訊放置在一開始的畫面
      document.querySelector('.live__title').innerHTML = `
    <h1>${JSON.parse(topNameRequest.response).top[0].game.name}</h1>
    <br>
    <p>Top 20 popular live streams sorted by current viewers<p>
    `;
      getStreams(`${JSON.parse(topNameRequest.response).top[0].game.name}`);
    }
  };
  topNameRequest.send();
}

getTopGames(); // 先取得前五名的遊戲名稱
document.querySelector('.navigator__items div').addEventListener('click', (e) => {
  if (e.target.classList.contains('btn')) { // 將點選到的遊戲名稱，轉為遊戲敘述印出
    document.querySelector('.live__title').innerHTML = `
    <h1>${e.target.innerText}</h1>
    <br>
    <p>Top 20 popular live streams sorted by current viewers<p>
    `;
    getStreams(`${e.target.innerText}`); // 輸入點選到的遊戲名稱，進入函式抓取出前二十名的實況
  }
});
