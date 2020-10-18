## Webpack 是做什麼用的？可以不用它嗎？
在 node.js 上，當主程式需要將 function 分離到其他檔案，以供更多不同的程式取用時，會採取 common JS 的規範。透過將功能 export 、主程式則以 require 取用。

而在瀏覽器的環境中，沒有 export \ require，而是採用Webpack 來作為讓程式模組化的工具，將欲輸出(export)的功能模組化打包後，再透過輸入(import)引入，瀏覽器上執行的主程式就可以使用已經被輸出的功能模組。

## gulp 跟 webpack 有什麼不一樣？
Gulp 是將工作排程決定好，讓電腦依照排程的順序及設定去執行任務

webpack 比較像是把各種不同的工具分類放好，但是主程式有個索引，當主程式執行時，會參照索引，將放在各個不同地方的工具透過 loader 引入主程式作動。

## CSS Selector 權重的計算方式為何？

＊ < Element(Type/標籤) < Class < ID < inline style < !important

＊ 是全站預設值，權重 0-0-0-0。

Element(Type/標籤)：Element (type/標籤) \ Pseudo-elements 偽元素 ，權重 0-0-0-1
class：psuedo-class(偽元素)\attribute（屬性選擇器），權重 0-0-1-0
Id：權重 0-1-0-0
Inline：直接寫在 html 行內的 style，ex: <div style=“color:red” >Yayaya</div> ，權重 0-1-0-0
!important：最高級的 css，權重 1-0-0-0

以上 selector 的權重是可以累加的
例如：
1.  .class li —> class + element —> 0-0-1-0 + 0-0-0-1 = 0-0-1-1
2.  span div ul li —> 4 個 element —> 0-0-0-1 * 4 = 0-0-0-4

而 css 的放置位置也是會影響其權重關係的：

inline style > 『 <head></head>』之間 > 外部連結link放置在下面 >  外部連結link放置在上面