const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function solve(input) {
  const tmp = input[0].split(' ');
  let eachNumber = 0;
  let num = [];
  for (let i = Number(tmp[0]); i <= Number(tmp[1]); i += 1) { // 跑出題目給的範圍內的數字
    let sum = 0;
    num = String(i).split('');// 切割成矩陣// number.length-->幾位數
    for (let j = 0; j < num.length; j += 1) { // j=0時，代表num矩陣最左邊的數
      eachNumber = (Number(num[j]) ** num.length);
      sum += eachNumber;
    }

    if (sum === i) {
      console.log(sum);
    }
  }
}

rl.on('close', () => {
  solve(lines);
});
