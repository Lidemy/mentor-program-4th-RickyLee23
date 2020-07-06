const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function solve(input) {
  const word = lines[0].split('');
  let afterWord = '';
  for (let i = word.length - 1; i >= 0; i -= 1) {
    afterWord += word[i];
  }
  if (input[0] === afterWord) {
    console.log('True');
  } else {
    console.log('False');
  }
}

rl.on('close', () => {
  solve(lines);
});
