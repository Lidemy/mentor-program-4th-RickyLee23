從國小到現在這麼老，架設伺服器這個詞彙一直是有出現在生活當中的，因為以前會玩遊戲，像是 RO 還是 
Minecraft ，都是一直聽到有人架設私服什麼的，但是我一直都擔任著受益者的角色，還蠻滿意一直都可以有別人的
伺服器可以給我使用，想不到這週終於輪到我也可以擁有自己的伺服器了，完美結束二十幾年的寄生蟲生涯。
先廣泛的找尋資料，先把 AWS (主機租用)、gandi（網域）的帳號辦起來，看到 AWS 豐富的網站、各種雲端服務，
把比較有可能和我的目的有關聯的資料大概看一下，像是託管靜態網站、或啟動 linux 虛擬機器，後來判斷應該是要
先啟動一個主機在我的遠端環境，但也不是很知道 EC2 跟 AMI 差在哪，後來發現似乎都是虛擬主機。一開始創了一
個 Amazon Linux 的 主機，但在不知道下一步該怎麼做的情況下，去查了資料，發現大家清一色都是使用 
ubuntu，我就關掉，並且跟著 magic lens 的教學文再創了一個 ubuntu ，後續循序跟著安裝了 tasksel \ 
LAMP，期間有覺得很特別厲害和我比較不懂的部分，主要是修改 phpmyadmin 的密碼的部分，流程中有運用到許多
較為底層的技巧，例如使用這行 sql 語法，啟用套件，讓 root 帳號可以登入。
```
UPDATE user SET plugin='mysql_native_password' WHERE User='root’;
```
還有載入特權表， 後來查資料有得知，如其名，它就是拿來調整使用者對於一般檔案、目錄檔等等的編輯權限。
跟著教學文做完後，把 IP 位址鍵入瀏覽器，ubuntu 預設的網頁就跳出來了！接著試著用 aws 文件上傳輸檔案的
指令，
```
ssh -i /path/my-key-pair.pem my-instance-user-name@my-instance-public-dns-name
```
用 terminal 把以前做過的 html 檔案放上網頁上提示的目錄位置，測試一下，有成功，太好了。
接著就是把我的部落格的多個 php 檔，也用同樣的方式送到 ubuntu 預設的資料夾位置，再用 mv 指令送到 /var/www/html

後續看完講解影片，之後我可以再研究的部分：
1. chmod \ chown \ top \ telnet \ curl 等等 CLI 指令
2. 使用 git 或者 FileZilla 傳檔案，FileZilla 有圖形介面，看起來還是比較直觀，避免有時候檔案傳錯地方都還不知道
3. 嘗試用 vim 編輯檔案，我是用 nano 指令
4. Phpmyadmin 匯出資料，我是自己又創了一次資料庫
5. 看完同學的作業，發現還有資安的部分...