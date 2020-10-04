## 請簡單解釋什麼是 Single Page Application

SPA ( Single Page Application ) : 單頁面應用程式 ; 和 SPA 相對的是 MPA ( Multi Page Application)
MPA 是當使用者 按下表單或者是向伺服器傳送 requset，而伺服器會將回傳的 response ( html 檔案 ) 送回給 client，client 進行畫面重整 ; 而 SPA 不一樣的是，當網頁不希望每按一個提交按鈕就重整一次畫面，而是希望留在同一個頁面，也許只有頁面的某一區塊需要產生新的畫面，其他區塊則是希望保持原貌。
這時候，背後的運作則是， client 利用 Ajax 發送出非同步的請求，server 端回傳的 response 則會送往瀏覽器上的 js，利用 js 處理接收到資料後，再動態呈現出頁面上所需的樣貌( client side rendering )，而畫面上，其餘原本不需被處理的畫面，則不需等待回傳的結果，也能繼續處理其他事情 ; 造就了 SPA 不需要畫面跳轉的成果。

## SPA 的優缺點為何

優點：

不用因為切換頁面，而將整個網站的資源重新載入

缺點：

檢視網頁原始碼時，是看不見 藉由 js 動態產生的資料的，
而搜尋引擎 SEO 若不會幫忙執行 js，網頁的曝光度相對會較低

## 這週這種後端負責提供只輸出資料的 API，前端一律都用 Ajax 串接的寫法，跟之前透過 PHP 直接輸出內容的留言板有什麼不同？

之前 PHP 直接輸出內容的作業，感覺很頻繁的切換頁面，也不斷地向後端下指令，拿取所需的資料

以新增留言為例，
之前的作業是要先切換到『add-comment』的頁面，輸入完之後又送到 handle_add_comment 的頁面處理，每次到不同頁面都要設定一次下次跳轉的畫面

這次的功課則是，在新增留言欄打好資訊之後，利用 ajax 送出去給 api_add_comment 處理，但是畫面沒有跳轉，而 api_add_comment 送回來的 response 可以即時的交給瀏覽器上的 js，執行完後呈現在網頁上。


以上作業參考資料來自：
[前端小字典三十天【每日一字】– SPA](https://ithelp.ithome.com.tw/articles/10160709)
[JS AJAX 筆記](https://medium.com/%E9%A6%AC%E6%A0%BC%E8%95%BE%E7%89%B9%E7%9A%84%E5%86%92%E9%9A%AA%E8%80%85%E6%97%A5%E8%AA%8C/js-ajax-%E7%AD%86%E8%A8%98-b9a57976fa60)
[前後端分離與 SPA](https://blog.techbridge.cc/2017/09/16/frontend-backend-mvc/)
[什麼是 Ajax？ 搞懂非同步請求 (Asynchronous request)概念](https://tw.alphacamp.co/blog/ajax-asynchronous-request)

