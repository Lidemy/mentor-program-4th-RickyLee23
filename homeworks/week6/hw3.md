## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。

<em> Content </em> : 用於字體樣式變更，將 Content 變為斜體字。

<article> Content </article> : 此標籤用於語意化，表示此區塊是文章內容。

<hr>：文字編輯所使用，可為分隔線


## 請問什麼是盒模型（box modal）

網頁設計相對於盒模型，就像大自然之於元素，
盒模型是網頁排版時最小的單位，而盒模型有幾項參數可以提供設計師、工程師進行調整
分別為 padding、border、margin、以及內容 content。
若盒模型中有個 content : abc

padding：當 padding 為 0 時，則 abc 距離 border 也會是零，padding 夾在 abc 與 border 之間。
        是 abc 與 border 之間的距離。
border：border 是元素的邊框，可以多種形式的粗細、樣貌展現。 
margin：margin 通常用於不同元素之間的區隔，margin 值越大，則兩元素之間的距離越遠。
## 請問 display: inline, block 跟 inline-block 的差別是什麼？

在排版中使用以下 display 會有不同的展現。
block：
盒模型的個參數，如 paddding、border、margin 皆可由 css 參數設定。
在瀏覽器中觀看時，其 row 方向將直接佔滿整行 ; 若排列多個盒模型，其樣貌會是由上到下排列。

inline：
排列時，該盒模型的 padding、border、margin 參數是可以被調整的，但是調整時，
是不會對上下相鄰元素產生影響的，比如說兩個 inline 元素排列成一上一下，當上面的獨立調整 padding 時，下方的 inline 元素是不會被上面的往下推的。
但是調整 padding，卻可以發現左右相鄰的元素是會被推開的。

inline-block：
對外可以如 inline 一樣併排元素，對內可如 block 一樣自由調整參數。簡單說是可以併在同一列的 block。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
static : 不跳脫排版流，以視窗作為相對基準點定位，也就是照著瀏覽器預設的配置排列。

relative : 不跳脫排版流，也以瀏覽器預設的配置排列，可加入部分屬性如 top、right、bottom、left 
           去做相對定位。

absolute : 跳脫排版流，以該標籤往上層尋找第一個 static 的元素，相對之做定位。

fixed : 跳脫排版流，以視窗為相對基準點定位，也可使用 top、right、bottom、left 屬性定位。
        您若將一元素以 fixed 屬性定義於視窗某處。則您在滑動滾軸時，該元素將不會沈入頁面當中。

