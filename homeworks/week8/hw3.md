## 什麼是 Ajax？
Asynchronous JavaScript and XML
是一種用非同步方式，並以 javaScript 內建的函式向伺服器傳送 request，待接收端接收到之後，再回傳 response，傳送方收到 response 之後才驅動某些事件．若有還沒接收到的空擋，則其餘不需等待 response的 js 程式是被允許可以先執行的。

## 用 Ajax 與我們用表單送出資料的差別在哪？
以表單送出資料，整個頁面都會重新整理過。是因為 Server 收到 request 並回傳 response 的時候，
會直接送往瀏覽器直接 render 出結果。

以 Ajax 方式，則 response 會回送到瀏覽器，瀏覽器也會送到 js。
在 js 上可以用選取器的方式，監聽被選取的物件，
若該物件被某行為觸動（比如說收到資料、被使用者按下...），
並再驅動某事件。不用因為任何送出資料的行為而讓整個頁面重新整理，
而是可以 js 去控制傳送方與接收方上的互動行為。

## JSONP 是什麼？
JSON with Padding 是跨來源請求中，除了 CORS 的另一種方式，將所指定所需的資料掛在網址上，利用 function 發送 GET 請求給接收方，接收方再回傳。

## 要如何存取跨網域的 API？
當現在瀏覽的網站與要呼叫的接收端「不同源」時，瀏覽器只能發出 request，而接收方不會回傳 response。
則利用 CORS(Cross-Origin Resource Sharing)跨來源資源共享的規範，Server 在 header，項目：Access-Control-Allow-Origin 中，加上 * ，或依不同的接收方規定，定義接受哪些 request header 或 method。

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
因為在第四週時，傳送資料是透過 node.js。
而第八週，則有經過瀏覽器，瀏覽器在安全性上會有更嚴謹的把控，不會讓傳送方傳送的每個 request 都可以得到許可，進而得到 response。

