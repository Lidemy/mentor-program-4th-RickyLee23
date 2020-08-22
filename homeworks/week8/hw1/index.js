const element = document.querySelector('.lottery__button');
const prize = document.querySelector('.activity__page');
const request = new XMLHttpRequest();
request.addEventListener('load', () => {
  if (request.status >= 200 && request.status < 400) {
    element.addEventListener('click', () => {
      let data;
      try {
        data = JSON.parse(request.responseText);
      } catch (err) {
        alert('error');
        console.log(err);
        return;
      }
      console.log(data.prize);
      if (data.prize === 'NONE') {
        prize.innerHTML = `
        <div class='get__prize'>
        <div class = 'prize__notice'>銘謝惠顧</div>
        <input type="button" class = 'lottery__button' onclick="javascript:window.location.reload()" value="我要抽獎" >
        </div>`;
        prize.classList.remove('activity__page');
        prize.classList.add('activity__page__none');
      } else if (data.prize === 'FIRST') {
        prize.innerHTML = `
        <div class='get__prize'>
        <div class = 'prize__notice'>恭喜你中頭獎了！日本東京來回雙人遊！</div>
        <input type="button" class = 'lottery__button'  onclick="javascript:window.location.reload()" value="我要抽獎" >
        </div>
        `;
        prize.classList.remove('activity__page');
        prize.classList.add('activity__page__first');
      } else if (data.prize === 'SECOND') {
        prize.innerHTML = `
        <div class='get__prize'>
        <div class = 'prize__notice'>二獎！90 吋電視一台！</div>
        <input type="button" class = 'lottery__button' onclick="javascript:window.location.reload()" value="我要抽獎" >
        </div>
        `;
        prize.classList.remove('activity__page');
        prize.classList.add('activity__page__second');
      } else if (data.prize === 'THIRD') {
        prize.innerHTML = `
        <div class='get__prize'>
        <div class = 'prize__notice'>恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！</div>
        <input type="button" class = 'lottery__button' onclick="javascript:window.location.reload()" value="我要抽獎" >
        </div>
        `;
        prize.classList.remove('activity__page');
        prize.classList.add('activity__page__third');
      } else {
        alert('沒東西啊！');
      }
    });
  } else {
    alert('怪怪的怪怪的！');
  }
});
request.onerror = function () {
  console.log('error');
};
request.open('GET', 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery', true);
request.send();
