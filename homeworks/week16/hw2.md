1. for 迴圈放到 stack，印出 i : 0
2. setTimeout 放到 Stack， 因是 webApi，請瀏覽器執行，等待 1000 微秒後放入 callback queue，同時間不影響 stack 運行
3. i++，現在 i = 1
4. for 迴圈放到 stack，印出 i : 1
5. setTimeout 放到 Stack， 因是 webApi，請瀏覽器執行，等待 2000 微秒後放入 callback queue，同時間不影響 stack 運行
6. i++，現在 i = 2
7. for 迴圈放到 stack，印出 i : 2
8. setTimeout 放到 Stack， 因是 webApi，請瀏覽器執行，等待 3000 微秒後放入 callback queue，同時間不影響 stack 運行
9. i++，現在 i = 3
10. for 迴圈放到 stack，印出 i : 3
11. setTimeout 放到 Stack， 因是 webApi，請瀏覽器執行，等待 4000 微秒後放入 callback queue，同時間不影響 stack 運行
12. i++，現在 i = 4
13. for 迴圈放到 stack，印出 i : 4
14. setTimeout 放到 Stack， 因是 webApi，請瀏覽器執行，等待 5000 微秒後放入 callback queue，同時間不影響 stack 運行
15. 迴圈執行結束，把 callback queue 的 cb 都抓出來執行
16. 印出 5
17. 印出 5
18. 印出 5
19. 印出 5
20. 印出 5