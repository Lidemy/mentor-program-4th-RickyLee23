```
var a = 1
function fn(){
  console.log(a)
  var a = 5
  console.log(a)
  a++
  var a
  fn2()
  console.log(a)
  function fn2(){
    console.log(a)
    a = 20
    b = 100
  }
}
fn()
console.log(a)
a = 10
console.log(a)
console.log(b)
```

### 先宣告變數：
```
global : {
    a : undefined
    fn: function
}
fn : {
    a : undefined
    fn2 : function
}
fn2 : {
}
```
### 名詞：
LHS : 尋找這個變數的位置在哪，我要賦值給他
RHS : 尋找這個變數的值是多少，我要用他

### 流程敘述，第 X 行程式碼
##### 1.對 a 做 LHS 引用 —> global —> 有宣告 —> 把 1 賦值給 a
```
global : {
    a : 1
    fn: function
}
fn : {
    a : undefined
    fn2 : function
}
fn2 : {
}
```
##### 16. 對 fn 做 RHS 引用 —> global —> 有宣告 —> 呼叫 function fn( )

###### 執行 function fn( )
##### 3. 對 a 做 RHS 引用 —> fn —> 有宣告 —> 印出 undefined
##### 4. 對 a 做 LHS 引用 —> fn —> 有宣告 —> 把 5 賦值給 a
```
global : {
    a : 1
    fn: function
}
fn : {
    a : 5
    fn2 : function
}
fn2 : {
}
```
##### 5. 對 a 做 RHS 引用 —> fn —> 有宣告 —> 印出 5
##### 6. 對 a 做 LHS —> fn 有宣告 —> a++ —> 把 a+1 賦值給 a，現在 a 是 6
```
global : {
    a : 1
    fn: function
}
fn : {
    a : 6
    fn2 : function
}
fn2 : {
}
```
##### 7. 重複宣告，可以不用理會
##### 8. 對 fn2 做 RHS 引用 —> fn —> 有宣告 —> 呼叫 function fn2( )

###### 執行 function fn2( )
##### 11. 對 a 做 RHS 引用 —> fn2 —> 沒有宣告 —> fn —> 有宣告 —> 印出 6
##### 12. 對 a 做 LHS 引用 —> fn2 —> 沒有宣告 —> fn —> 有宣告 —> 把 20 賦值給 a
```
global : {
    a : 1
    fn: function
}
fn : {
    a : 20
    fn2 : function
}
fn2 : {
}
```
##### 13. 對 b 做 LHS 引用 —> fn2 —> 沒有宣告 —> fn —> 沒有宣告 —> global —> 把 100 賦值給 b
```
global : {
    a : 1
    fn: function
    b : 100
}
fn : {
    a : 6
    fn2 : function
}
fn2 : {
}
```
###### 跳出 fn2 ( )

###### 跳回 fn( )

##### 9. 對 a 做 RHS 引用 —> fn —> 有宣告 —> 印出 20
###### 跳出 fn( )

##### 17. 對 a 做 RHS 引用 —> global —> 有宣告 —> 印出 1
##### 18. 對 a 做 LHS 引用 —> global —> 有宣告 —> 把 10 賦值給 a
```
global : {
    a : 10
    fn: function
    b : 100
}
fn : {
    a : 6
    fn2 : function
}
fn2 : {
}
```
##### 19. 對 a 做 RHS 引用 —> global —> 有宣告 —> 印出 10
##### 20. 對 b 做 RHS 引用 —> global —> 有宣告 —> 印出 100

### 答案：
undefined
 5
 6
 20
 1
 10
 100