const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function whosPrime(result) {
  for (let i = 1; i < result.length; i += 1) { // 陣列[0]代表總運算量，其餘均帶入找因數
    let count = 0;
    for (let j = 1; j <= Number(result[i]); j += 1) { // 每個陣列皆帶入比自己小or等於自己的數，找其因數
      if (result[i] % j === 0) { // 發現一因數則count加一
        count += 1;
      }
    }
    if (count === 2) { // 若僅有兩個因數則為質數
      console.log('Prime');
    } else if (count > 2 || count < 2) { // 若超出兩個因數則為合數 ＆ 1的因數只有一個，題目要求回傳composite
      console.log('Composite');
    }
  }
}
rl.on('close', () => {
  whosPrime(lines);
});
