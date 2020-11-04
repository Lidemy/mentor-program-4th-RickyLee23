### 解題敘述：
EventLoop 是一段會依照順序反覆執行的底層運作，
區分成了幾個區塊：
Stack \ WebApi \ callback queue
順序是：
一. 執行 stack 同步的程式，遇到非同步的 function，就丟到 webApi
二. webApi 裡的程式執行完就放到 callback queue 
三. 在stack 裡 run 完第一輪的程式後，再把 callback queue 中的程式放進 stack 繼續跑
四. 回到一。

### 解題流程：
1. console.log(1) 放入 stack 並執行，印出 1
2. 將第一個 setTimeout 放在 stack 執行，因為是 webApi，請瀏覽器執行，執行後回傳結果並丟到 callback queue 排隊
3. console.log(3) 放入 stack 並執行，印出 3
4. 將第二個 setTimeout 放在 stack 執行，因為是 webApi，請瀏覽器執行，執行後回傳結果並丟到 callback queue 排隊
5. 執行 stack內的項目，印出 5，此時 stack 已清空
6. 再將 callback queue 的項目抓進 stack 執行
7. 執行 stack 內的項目，印出 2
8. 執行 stack 內的項目，印出 4
9. 清空 stack

### 題解：
1
3
5
2
4
