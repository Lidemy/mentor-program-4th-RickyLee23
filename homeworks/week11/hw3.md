## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
雜湊和加密不一樣！
明文經過加密後的密文，是可以再經過相同演算法解密之後還原回明文的，也就是一對一的關係 ; 
而明文經過雜湊得到的密碼，則是不可逆的，無法經過還原之後回到明文，甚至有微小機率的情況下，不同的明文經雜湊可以得到相同的密文。

## `include`、`require`、`include_once`、`require_once` 的差別
include_( ) 和 include_once ( ) 的差異在於 include_once 會先檢查要匯入的檔案，
有沒有在該程式其他地方被匯入過了，有的話又不會再重複匯入，因為 PHP 不允許相同名稱的函式被重複宣告第二次。
require_once 也有上述的功能。

require( ) 和 include( ) 主要差異在於處理失敗上的不同：
require( ) 執行時，如果帶進來的檔案發生錯誤的話，會顯示錯誤，並且立即終止程式。
Include( ) 執行時，如果帶進來的檔案發生錯誤，則是顯示警告，不會立刻停止。

## 請說明 SQL Injection 的攻擊原理以及防範方法
SQL Injection 是當駭客在輸入資料並傳送到 server 端時，在資料中安插 SQL 的程式語法，送出之後，參雜在 php 的程式當中，並被送到資料庫被執行。
比如說某表格設定為，需要使用者輸入 username 以及 password，SQL設計則是  
select * from users where username = ‘%s’ and password = ‘%s’，
則駭客只要在 username 欄位中鍵入 : aa'# ，#會讓後方的程式碼都變成註解，而駭客就不需要知道 aa 的 password ，就可以順利竊取 aa 的密碼。
若要防範 SQL Injection ，可以在 php 程式碼中，把 sql 語句加入到 prepare( ) ;
然後再綁定參數 bind_param( )，告訴電腦我要輸入的參數及其參數型態，如此不會被當作指令來執行而是字串。

##  請說明 XSS 的攻擊原理以及防範方法
XSS, Cross Site Scripting, 跨站攻擊指令碼，可以在使用者輸入的區塊中，加入script標籤，標籤中撰寫指令：
，則該網頁執行時，該指令也會被一併執行。
若要防範，可以利用 php 內建的 htmlspecialchars 跳脫字 元功能，由後端過濾掉一些可能帶有惡意的字元
比如說將原始字元 < 跳脫成 & lt;

## 請說明 CSRF 的攻擊原理以及防範方法
CSRF (Cross Site Request Forgery) : 跨站請求偽造
在不同 domain 下，偽造出使用者本人發出的 request

### 攻擊情境：
1.用 GET 當作傳送方式：如果使用者是登入狀態，那只要誘使使用者在不知情下，傳送出帶有變更指令的網址，Request 就等於是使用者自己主動發出的。
2.用 POST 當作傳送方式：攻擊者可以做出一個會自動提交的form，另外再做一個隱藏的iframe，當form 提交後，target 設定為在 iframe 中顯示，則使用者完全不知道發生了什麼事。
3.若後端只接收 json：若後端檢查項目，有檢查到 content type 的機制的話，可以避免掉攻擊 ; 但如果 server 的 CORS 機制是將 header 中的 Access-Control-Allow-Origin 打開的，則任何 domain 都還是能跨網域進行惡意攻擊。
————--
### Server的防禦
ㄧ.
由伺服器判定 request header 叫做 referer 的欄位，是否來自合法的 domain，但要注意以下情況。
1.瀏覽器不會帶 referer 
2.使用者將自動帶 referer 的功能關閉
3.伺服器用來判定 request 來自是否為合法 domain 的程式碼需要沒有 bug
二.
驗證碼：使用起來安全但是麻煩，假若在網頁上按個刪除鍵就要打一次驗證碼，不是很好的體驗
三.
確保某些資訊只有使用者知道:
1.加上 CSRF token ：做一個 hidden 的csrftoken，server 利用 session 存的 token 比對與 request 的 token 是否相同。
2.Double Submit cookie ：攻擊者無法從不同 domain 帶上附有 CSRF token 的 cookie 就會被擋下來。
3.Client 端的 Double submit cookie ：token 目的只是不被攻擊者猜出，故由 client 端生成也是一樣的。


### 由 browser 防禦：利用 Google 51 版新功能： SameSiteCookie
有兩種模式：
Strict: cookie 只可在 same site 使用，不可以再 cross site request 被加入
Lax:放寬了限制，<a> , <link rel=‘prender’>,<form method=“GET”>諸如此類還是會帶上Cookie, 但若使用 POST,PUT,DELETE 則不會帶上Cookie

皆參考至 huli 老師的 [讓我們來談談 CSRF](https://blog.techbridge.cc/2017/02/25/csrf-introduction/)
及 Yakim 助教的[整理](https://yakimhsu.com/project/project_w12_Info_Security-CSRF.html)
但我其實中段之後就看不太懂了，可能要待之後複習時再思考。趕進度先
