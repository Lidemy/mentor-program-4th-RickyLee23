import styled from "styled-components";
import React from "react";
const BoardWrapper = styled.div``;
const ContentBox = styled.div`
  box-sizing: border-box;
  position: absolute;
  top: 200px;
  left: 200px;
  width: 900px;
  height: 900px;
  box-shadow: 10px 10px 10px gray;
  display: flex;
  flex-wrap: wrap;
  background: wheat;
`;
const Container = styled.div`
  box-sizing: border-box;
  width: 950px;
  height: 950px;
  position: absolute;
  top: 175px;
  left: 175px;
  display: flex;
  flex-wrap: wrap;
`;
const Box = styled.div`
  box-sizing: border-box;
  width: 50px;
  height: 50px;
  border: 1px solid #121212;
`;
const BoxKey = styled.div`
  box-sizing: border-box;
  width: 50px;
  height: 50px;
  border-radius: 25px;
  border: none;
  cursor: pointer;

  &.black {
    background: radial-gradient(
      circle at 35% 25%,
      #999 0%,
      #000 90%,
      #666 95%,
      #999 100%
    );
  }
  &.white {
    background: radial-gradient(
      circle at 35% 25%,
      white 0%,
      #eee 30%,
      #ccc 60%,
      #bbb 80%,
      #aaa 95%,
      #999 100%
    );
  }
`;
const GotWinner = styled.div`
  position: fixed;
  z-index: 999;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  color: white;
  font-size: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
`;

function winOrNot(newBoard, x, y, DirectionX, DirectionY) {
  let now = newBoard[y][x];
  let counter = 0;
  do {
    x = x + DirectionX;
    y = y + DirectionY;
    if (now === newBoard[y][x]) {
      counter++;
    } else {
      break;
    }
  } while (true);
  return counter;
}

function App() {
  const [board, setBoard] = React.useState(
    Array(19).fill(Array(19).fill(null))
  );
  const [blackIsNext, setBlackIsNext] = React.useState(true);
  const [winner, setWinner] = React.useState("");

  let circles = []; //每一個下棋的位置
  for (let x = 0; x < 19; x++) {
    for (let y = 0; y < 19; y++) {
      circles.push(
        <BoxKey onClick={(e) => updateBoard(e, x, y, blackIsNext)}></BoxKey>
      );
    }
  }

  function updateBoard(e, x, y, blackIsNext) {
    const newBoard = JSON.parse(JSON.stringify(board));

    if (newBoard[y][x] === null) {
      //如果是沒下過的位置，才能下
      setBlackIsNext(!blackIsNext);
      let newValue = blackIsNext === true ? "black" : "white"; //如果接下來是黑棋，就把 'black' 賦值給 newValue
      e.target.classList.add(newValue); //直接改變選取到的 BoxKey 顏色，newValue 加在 class
      newBoard[y][x] = newValue;
      setBoard(newBoard);

      if (
        winOrNot(newBoard, x, y, 1, 0) + winOrNot(newBoard, x, y, -1, 0) >= 4 ||
        winOrNot(newBoard, x, y, 0, 1) + winOrNot(newBoard, x, y, 0, -1) >= 4 ||
        winOrNot(newBoard, x, y, 1, -1) + winOrNot(newBoard, x, y, -1, 1) >=
          4 ||
        winOrNot(newBoard, x, y, 1, 1) + winOrNot(newBoard, x, y, -1, -1) >= 4
      ) {
        if (newBoard[y][x] === "black") {
          setWinner("黑子");
        } else {
          setWinner("白子");
        }
      }
    }
  }

  let squares = []; //每一方格的外觀
  for (let i = 0; i < 324; i++) {
    squares.push(<Box />);
  }

  return (
    <BoardWrapper>
      {winner && (
        <GotWinner>
          沒錯......{winner}贏了
          <button onClick={() => window.location.reload()}>再玩一次</button>
        </GotWinner>
      )}
      <ContentBox>{squares}</ContentBox>
      <Container>{circles}</Container>
    </BoardWrapper>
  );
}

export default App;
