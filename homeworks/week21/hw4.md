## 為什麼我們需要 React？可以不用嗎？

可以的！但是 React 讓我們以不同的思考邏輯和更簡短的方式去撰寫程式。
單純只用 JS 語法寫程式的話，當要選一個 html 元素時，會需要設定 querySelector 並在元素上加入 id 、class 去選取 ; 若要監控該元素，還需要加上 addEventListener，寫出來的程式碼會有很多部分是在操作 DOM。

React 環境可以很簡單的用 class component 或者 functional component 去切分不同功能的元件，這些 component 也可以很輕易的被重複使用。
React 中的 useState，讓資料改變的同時去改變 UI。

## React 的思考模式跟以前的思考模式有什麼不一樣？
#### 一般寫法：
##### 把資料放在畫面 再一起呈現，畫面跟資料是綁在一起的
##### 擷取資料方式：
###### 1. 從 UI 上把資料擷取出來 querySelector  例如 .text .val .innerText 之類給資料 --> 轉成 UI --> 再從 UI 把資料轉出來
###### 2. 在 html 元素上面 做一個屬性 data-id ，資料則另外存一個變數 id ，把 id 值存到 html 的屬性 data-id 裡面

#### React 寫法：
##### JSX : 把 html 的語法寫在 js 裡面，傳資料用 props 由父組件往下傳到子組件
##### 要改變畫面，就先改變 state 裡的資料。由資料去控制畫面，setState 之後，畫面會重新 render。

## state 跟 props 的差別在哪裡？

props 是從上層的父元件 往下傳輸的參數，可以是變數也可以是 function ，

state 是包起來的一串資料，可以是物件、也可以是陣列、可以是物件裡的陣列、也可以是陣列裡的物件。React 會去對照每一次改變之後 state 與前一次 state 的差異，再重新 render，表現出新一次的 state 所對應的 view 。

