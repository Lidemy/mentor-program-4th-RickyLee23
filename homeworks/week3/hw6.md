## hw1：好多星星
這是這禮拜作業最簡單的一題，讚讚，然後從這題以後我卡了四天ＸＤＤ

## hw2：水仙花數
我的思路是：
先用迴圈（第一圈）把題目給的範圍內的數字都跑出來，
再用迴圈（第二圈）分解每個數字，有幾位數就分解成幾個陣列，再把每個位數的Ｘ次方全部加起來，如果相加起來跟我第一圈跑的數字相等，那就符合水仙花數。之後再研究有沒有比較不耗資源的寫法，哈哈，這題蠻有成就感的，因為都沒看解法。

## hw3：判斷質數
參考老師的Readme之後，決定先找出 input 的因數，再用計數的方式，若只有 count 到兩次，則代表該數只有兩個因數，即符合質數的定義。 

## hw4：判斷迴文
對新手頗人性化的一題。

## hw5：聯誼順序比大小
寫這題又再度讓我學了一次『看清楚題目』這件事，翻了某幾個同學的作業之後，才注意到原來除了要注意用字串比較之外，原來字串比較是從左而右，真酷。'3'竟然可以大於'123'。
我把判斷式分了好幾階處理：
第一階先判斷，陣列的字串長度是否相等，若相等則第二階直接進入比較字串 ; 若不相等，則從位數判斷大小。
這題寫完發生一點小插曲，先送 LIOJ Accept 成功之後，再用 eslint 改過，改完又送了一次竟然變ＷＡ。整個心涼到不行（眼神死），還好還是有耐心的再重新看過一次，才發現 eslint 系統不允許 == （一般相等）的存在，而我改成 === （嚴格相等）之後，沒注意到將要將字串轉成數字才能判斷，真的有學到了這次。

