## 修复与体验优化

- 🐛 **修复首页刷新闪现无样式页面（FOUC）**：页面模板先输出 `<body>` 再输出 `<!DOCTYPE>/<head>`，浏览器落入怪异模式(Quirks)导致 CSS 不再阻塞渲染；修正 `index/post/page/Archives` 模板加载顺序（`head.php` 先于 `header.php`），Google Fonts 改为异步加载不阻塞首屏
- 🐛 **修复"回到顶部"按钮点击无反应**：怪异模式下 `documentElement.scrollTop` 恒为 0 导致平滑滚动立即终止；平滑滚动改用 `document.scrollingElement`，任何模式下均可靠
- 🐛 **修复文章目录高亮冻结/点击不跳转**：文章标题缺少 id 锚点导致 tocbot 目录链接退化为 `#`；自动为无锚点标题生成锚点 id（`toc-heading-N`），新增 `headingsOffset: 60` 修正固定顶栏下的高亮判定与跳转落点
- 🔧 **精简控制台冗余设置**：移除右下角齿轮设置面板（手动明暗切换/字号调节/字体切换）、前台登录表单与后台入口、已登录态快捷按钮；仅保留"回到顶部"与"文章目录伸缩"按钮（无目录时自动隐藏）
