## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？
Domain Name Server 是網域名稱伺服器：當使用者要前往有著一串文字所組成的網域名稱時，交給名稱伺服器處
理，名稱伺服器會再回傳該網域名所對應的 IP 地址。
Google 可以從使用者轉去的網址去得到大數據資料！

[Reference](https://briian.com/6667/)

## 什麼是資料庫的 lock？為什麼我們需要 lock？
避免產生 race condition ，由不同處發出的 request 有可能會同時抵達伺服器並同時執行同一行程式，這時有
機會發生重複執行的問題，若此行程式是購物網站的庫存系統，那在商品快要售罄的階段，有多個人同時按下搶購，則
會發生超賣的情況。這時可以由後端資料庫的程式設計去改善此情況。
如何改善：當同樣的的程式碼，在平行的情況下分頭執行時，我們可以將最先執行的 lock 起來，其他的執行緒就必
須等待第一個執行完之後，才依序執行。
Ex: 
SELECT amount FROM products WHERE id = 1 for update，原本沒有加上 for update 的時候，每個執
行緒都會執行。
加上 for update 後，則只有第一個執行緒會繼續往下執行，其餘的就得等待。

缺點：效能上的損耗

Reference:
[用 SELECT ... FOR UPDATE 避免 Race condition](https://blog.xuite.net/vexed/tech/22289223-%E7%94%A8+SELECT+...+FOR+UPDATE+%E9%81%BF%E5%85%8D+Race+condition)

## NoSQL 跟 SQL 的差別在哪裡？
SQL：SQL是用來管理或查詢關聯式資料庫的程式語言，每一筆資料都是  table 中的一個 record，再把 table 集合起來，就成為一個關聯式資料庫。資料和資料之間有清楚的關聯，比如說『客戶訂單』，會有客戶資訊和訂單資訊需要有關聯，但兩種資料會分開存放。

NoSQL （Not Only SQL) ：非關聯資料庫，通常用於超大規模資料的儲存，目的和關聯式不一樣，主要要求是能處理高速、大量產生的資料，但不用即時同步、也不用毫無誤差。資料物件會由『屬性-值』或陣列組成

使用情況：
適合使用 SQL 的情況：
以 ATM 匯出 5000元，那系統一定要同步帳戶帳戶扣除了這筆款項的訊息，否則到了其他 ATM，帳戶裡的結餘可能還是匯款之前的金額。
使用 NOSQL 的情況：
一個臉書上的文章，可能被來自四海八方的網友同時按下讚，某些使用者可能馬上就看到按讚數的累加、某些人可能相隔數秒才會看到，這種延誤，並不會有什麼大問題，但是卻能夠處理大量的資料。
[SQL/NoSQL是什麼？認識資料庫管理系統DBMS](https://tw.alphacamp.co/blog/sql-nosql-database-dbms-introduction)

## 資料庫的 ACID 是什麼？
A (Atomicity)：基元性 —>  一筆交易(Transaction)，必須是全部執行、或全部不執行。
全部執行 —> 交易正確完成，並存入資料庫。
全部不執行 —> 交易途中發生錯誤，必須將交易回復到執行前

C (Consistency)：一致性 —> 交易的前後皆滿足設定的限制。
EX：小明和小美加起來的總資產是 1000元，小明利用 ATM 轉帳 500 元給小美，小美多了 500 元，但最終結果，兩人的總和還是 1000 元

I (Isolation)：孤立性 —> 交易期間，不容許其他交易讀取或寫入。

D (Durability \ Permanency)：永久性 —> 交易一經 commit 之後，永久有效。