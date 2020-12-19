## 請列出 React 內建的所有 hook，並大概講解功能是什麼

### useState：
const [state, setState] = useState(initialState);
state 裡裝的是此刻狀態的資料， setState() 則是如何改變此刻狀態的資料，
而資料一但改變，re-render 過後，state 就會被更新為上次 setState() 括號裡，最後更新的 state。

### useEffect：
useEffect 有兩個參數，第一個是函式，第二個是陣列。
陣列裡的[x]，x若發生改變，會再次觸發 effect function。如果[ ]裡是空的，則此 effect function 只會觸發一次
[參考](https://ithelp.ithome.com.tw/articles/10215225)


### useContext：
一般從父組件把 props 往下傳到子組件，會寫在 jsx 裡面，但如果遇到中間有多層架構，則傳資料的寫法變得很冗餘。
useContect 可以在上層 <MyContext.Provider> 把值往下傳，則要用到值的子組件只要宣告一變數，從 useContext 取值即可。

### useReducer：
更複雜的 useState、當你需要複雜的 state 邏輯而且包括多個子數值或下一個 state 依賴之前的 state，useReducer 會比 useState 更適用
[Hooks API 參考](https://zh-hant.reactjs.org/docs/hooks-reference.html#usereducer)

### useCallback：
根據官網的範例：useCallback 可以把第一個參數暫存在記憶體。a,b 的值不變的情況下，memoizedCallback 的引用不變，可以減少渲染，達到性能優化的效果
```
const memoizedCallback = useCallback(
  () => {
    doSomething(a, b);
  },
  [a, b],
);
```
[如何錯誤地使用 React hooks useCallback 來保存相同的 function instance](https://medium.com/@as790726/%E5%A6%82%E4%BD%95%E9%8C%AF%E8%AA%A4%E5%9C%B0%E4%BD%BF%E7%94%A8-react-hooks-usecallback-%E4%BE%86%E4%BF%9D%E5%AD%98%E7%9B%B8%E5%90%8C%E7%9A%84-function-instance-7744984bb0a6)
[useCallback、useMemo 分析 & 差别](https://github.com/monsterooo/blog/issues/37)

### useMemo：
根據官網的範例：
在 a,b 值不變的情況下，memoizedValue 的值不變，也就是 useMemo 的第一個參數不會變。useMemo 暫存的是  callback function：computeExpensiveValue 的值。
```
const memoizedValue = useMemo(() => computeExpensiveValue(a, b), [a, b]);
```

### useRef：
跟 useState 一樣都可以在 component 生命週期中保存資訊，且 re-render 仍可被保存，但 useRef 建立的變數，被改變時並不會觸發 re-render。
[參考](https://dotblogs.com.tw/wasichris/2020/03/26/181546)

### useImperativeHandle：
可以利用 ref ，從子組件傳送值或函式到父組件
[參考](https://medium.com/@binyamin/react-hooks-useref-useimperativehandle-uselayouteffect-ede6f40f393e)

### useLayoutEffect：
在 hook 的 flow diagram 中，useLayoutEffect 會在 browser 畫出畫面之前先執行，就不會看到瀏覽器已經畫出畫面，但又閃了一下跑出 useEffect 執行的結果。

### useDebugValue：
用在自定義的 hook 中，在 React Devtool 裡面顯示 custom hook 的名稱與 debug 的值
[React Hooks 筆記](https://medium.com/@scars.yao/react-hooks-%E7%AD%86%E8%A8%98-9f9d99c0b72e#e461)

## 請列出 class component 的所有 lifecycle 的 method，並大概解釋觸發的時機點

componentDidMount：component mount 的時候會執行。
componentWillUnmount：把 component 從畫面上去除、unmount 的時候，

componentDidUpdate：component update 之後，會有兩個參數，分別是前一次的 state 跟前一次的參數

1. state 改變的時候，第一次先跑 componentDidMount，再跑 render( ) 裡的程式
2. 執行 componentDidUpdate 的程式
3. 若有 component 被畫面上移除掉則執行 componentWillUnmount

## 請問 class component 與 function component 的差別是什麼？

### class component : 
1. 要使用 state，必須定義一個 state 物件，更改 state 則須透過 setState 這個內建函式
2. 寫法較煩瑣，參雜 this、物件導向觀念
3. class component 有元件週期可以操作



### function component ：
1. 可以套用 useState 這個 hook 去控制 state。
2. 較為簡潔
3. 不用把 render() 寫進去
4. 編譯較快

## uncontrolled 跟 controlled component 差在哪邊？要用的時候通常都是如何使用？

被 React 控制住是 controlled component，反之是 uncontrolled component 

### controlled component ：

先宣告一個 useState，const [value, setValue] = useState(' ')
程式在一個 input 元件中放入 onChange 監控，並且 onChange 事件可以傳入 e 控制到另一個 setState(e.target.value)，則 value 的值是直接由 React 控制的。

### uncontrolled component ：

可以在 input 中放 class，再用querySelector 抓出 input 的 value 去做操作，這種方式就不會用到 React。