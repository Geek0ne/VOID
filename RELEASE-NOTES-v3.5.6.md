## 新增、样式优化与修复

- 🐛 **修复归档页（Archives）文章链接丢失**：Typecho 1.3 起 `Widget\Base\Contents::filter()` 不再向数据行写入 `permalink` 字段，`Contents::archives()` 仍直接读取 `$row['permalink']`，在 PHP 8 下会抛出 `Undefined array key "permalink"` 警告（警告文本直接混入页面 HTML），归档列表的文章链接也随之变为空值；现按核心同款算法（路由表 + 站点 index）为纯数据行补出永久链接，与 `sitemap.php` 的处理方式保持一致，同时修正摘要分支误用旧版 `content` 列名的问题
- ✨ **代码块增强**：代码块右上角显示编程语言标签 + 一键复制按钮（点击后提示「已复制」）；语法高亮扩充至 60+ 种语言，含 Rust / Golang / 汇编 / TypeScript / Kotlin / Scala / Groovy / Perl / Dockerfile / NGINX / INI 等；`k8s`、`helm`、`compose` 等围栏自动按 YAML 处理，`conf` 按 INI 处理，兼容大写围栏
- ✨ **无主图文章自动回退默认头图**：文章未设置主图（主图字段为空或缺失）时自动使用主题默认头图，可配合 `/wallpaper.php` 每日必应壁纸跳转实现每日自动换壁纸
- 🎨 **移动端文章正文字号调小两号**：≤767.5px 下 `.yue` 正文默认字号 18px → 16px，后台字号调节档位同步 -2px
- 🎨 **文章正文链接配色**：未访问显示蓝色（`#0000cc`），已访问显示紫色（`#660099`），暗色模式自动切换为亮蓝 / 亮紫变体以保证可读性
