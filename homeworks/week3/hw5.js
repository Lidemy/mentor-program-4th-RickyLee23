const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function whosBig(result) {
  for (let i = 1; i < result.length; i += 1) {
    const num = result[i].split(' ');
    if (num[0].length === num[1].length) { // 第一階：判斷字串長度-->相等
      if (num[0] > num[1]) { // 第二階：陣列0 > 1
        console.log(Number(num[2]) === 1 ? 'A' : 'B'); // 第三階：陣列2為1時的判斷
      } else if (num[0] < num[1]) { // 第二階：陣列1 > 0
        console.log(Number(num[2]) === -1 ? 'A' : 'B'); // 第三階：陣列2為-1時的判斷
      } else { // 第二階：字串相等，陣列0和陣列1的字典序也相同
        console.log('DRAW');
      }
    } else if (num[0].length > num[1].length) { // 第一階：判斷字串長度-->不相等，故一定不會有'DRAW'發生
      console.log(Number(num[2]) === 1 ? 'A' : 'B');
    } else if (num[0].length < num[1].length) { // 第一階：判斷字串長度-->不相等，故一定不會有'DRAW'發生
      console.log(Number(num[2]) === -1 ? 'A' : 'B');
    }
  }
}

rl.on('close', () => {
  whosBig(lines);
});
