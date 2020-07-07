const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});


function solve() {
  let sum = '';
  for (let i = 1; i <= lines; i += 1) {
    sum += '*';
    console.log(sum);
  }
}

rl.on('close', () => {
  solve(lines);
});
