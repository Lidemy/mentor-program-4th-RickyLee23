## 什麼是 DOM？
Document Object Model (檔案物件模型)：
DOM 是多種瀏覽器與 HTML 連結的介面，將 HTML 的標籤定義成節點，並解析成樹狀關係，
確立關係後，再用多種選取器去選取所需的節點，將想要執行的程式套用在節點當中。

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？

 當 DOM 已經將 HTML 解析成樹狀關係時，從根節點到目標節點，事件傳送的途徑就叫做捕獲階段 ; 
 而到了目標節點之後，事件從目標節點又被傳回去給根節點，此回程途徑稱為冒泡階段。


## 什麼是 event delegation，為什麼我們需要它？

事件代理機制（ event delegation )：在上層使用代理機制，即可有效利用少量的 function 去監聽下層的元素 ; 即便後續在下層新增了多個元素，也不需要額外設定 listener，以上層代理監聽即可。



## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？

event.preventDefault():阻止瀏覽器預設的行為
event.preventPropagation():取消事件繼續往下傳遞

preventDefault()有點像是拿了黑布罩住了手電筒的光，你看不到光，但是其實內部的電池、線路都還是有在傳輸電流，把電能轉換成光能。
preventPropagation()則是把手電筒的某段線路剪斷了，所以確實的阻斷了的電流訊號的傳輸。
不知道這樣子比喻好不好
