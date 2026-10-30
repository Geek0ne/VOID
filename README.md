# VOID-Plus

> ✏ 一款简洁优雅的 Typecho 主题

**本仓库是由 Geek0ne 独立维护的增强改进版**，在原版基础上持续维护，加入了安全加固、Typecho 1.3 / PHP 8.x 兼容等改进。

作为计算机术语时，VOID-Plus 的意思是「无类型」。

![](https://raw.githubusercontent.com/Geek0ne/VOID-Plus/master/screenshot.png)

<p align="center">
  <a href="https://github.com/Geek0ne/VOID-Plus/actions"><img alt="Build" src="https://github.com/Geek0ne/VOID-Plus/actions/workflows/ci.yml/badge.svg"></a>&nbsp;&nbsp;&nbsp;
  <a href="https://github.com/Geek0ne/VOID-Plus/releases"><img alt="release" src="https://img.shields.io/github/v/release/Geek0ne/VOID-Plus?style=flat-square"></a>&nbsp;&nbsp;&nbsp;
  <a href="https://github.com/Geek0ne/VOID-Plus/blob/master/LICENSE"><img alt="license" src="https://img.shields.io/github/license/Geek0ne/VOID-Plus?style=flat-square"></a>
</p>

## 特性

> 原介绍文章：[VOID：现在可以公开的情报](https://blog.imalan.cn/archives/247/)。

* 响应式设计
* PJAX 无刷新体验
* AJAX 评论
* 前台无跳转登陆（兼容 PJAX）
* 自动夜间模式
* 优秀的可读性
* 衬线、非衬线两种文字风格
* 代码高亮（浅色暗色两种风格，随主题切换）
* Mac 风格代码块（可开启或关闭）
* 代码行号
* 站点样式设置面板（日夜转换、字体、字号）
* MathJax 公式
* 表情解析（文章、评论可用）
* 图片排版（可用作相册）
* 图片懒加载
* 灵活的头图设置
* 文章目录解析
* 完整的结构化数据支持
* 够用的后台设置与丰富的高级设置

结合附带的配套专用插件，还有更多功能：

* 浏览量统计
* 文章点赞
* 文章字数统计
* 评论投票与自动折叠
* 访客互动展示

以及其他很多细节，总之用起来还算舒服。这里有一个[示例页面](https://blog.imalan.cn/archives/194/)，可以看到 VOID-Plus 对常用写作元素的支持以及一些特色功能演示。

## 开始使用

1. 下载主题：[发布版](https://github.com/Geek0ne/VOID-Plus/releases)，注意是下载 VOID-Plus.zip 这个压缩包，而不是 Source code
2. 解压
3. 将**主题文件夹下**的 VOID-Plus 文件夹上传至站点 /usr/themes 目录下
4. 后台启用主题
5. 将**配套插件文件夹下**的 VOIDPlus 文件夹上传至站点 /usr/plugins 目录下
6. 后台启用插件

* 可选：将主题 `assets` 文件夹下的 `VOID-CacheRule.js` 复制一份到站点根目录，并在主题设置中启用 Service Worker 缓存。
* 可选：主题文件夹下 advanceSetting.sample.json 中有一些高级设置，可以看看。

## **常见问题（请务必仔细阅读）**

<details><summary>如何开启文章点赞？</summary><br>

文章点赞功能依赖配套插件，请上传至插件目录并启用。插件随主题发行包提供（VOID-Plus.zip 的 `2.配套插件/VOIDPlus` 文件夹），上传至 `/usr/plugins` 目录后台启用即可。

</details>

<details><summary>如何开启文章浏览量统计？</summary><br>

文章浏览量统计功能依赖配套插件，请上传至插件目录并启用。插件随主题发行包提供（VOID-Plus.zip 的 `2.配套插件/VOIDPlus` 文件夹），上传至 `/usr/plugins` 目录后台启用即可。

</details>

<details><summary>如何开启文章字数统计？</summary><br>

文章字数统计功能依赖配套插件，请上传至插件目录并启用。插件随主题发行包提供（VOID-Plus.zip 的 `2.配套插件/VOIDPlus` 文件夹），上传至 `/usr/plugins` 目录后台启用即可。

</details>

<details><summary>下载安装后样式不对？</summary><br>

仓库中的是未压缩的源代码，包含大量实际使用中不需要的文件，并且可能无法直接使用。请一定通过[发布版](https://github.com/Geek0ne/VOID-Plus/releases)下载主题，下载 VOID-Plus.zip 压缩包，而不是 Source code。

</details>

<details><summary>添加归档页面</summary><br>

新建独立页面，自定义模板选择 `Archives`，内容留空。

</details>

<details><summary>添加友情链接</summary><br>

新建独立页面，然后如此书写：

```
[links]
[示例站点](https://example.com)+(https://example.com/avatar.jpg)
[另一个示例](https://example.org)+(https://example.org/avatar.jpg)
[/links]
```

文章中、独立页面中都可以通过该语法插入类似的展示块。在某些 Typecho 版本中 HTML 会被转义后输出，请使用 `!!!` 包裹以上代码，例如：

```
!!!
[links]
···
[/links]
!!!
```

`!!!` 需要单独占一行。

</details>

<details><summary>图片排版</summary><br>

在文章中，使用 `[photos][/photos]` 包起来的图片可显示在同一行。例如：

```
[photos]
![](https://cdn.imalan.cn/img/post/2018-10-26/IMG_0073.jpeg)
![](https://cdn.imalan.cn/img/post/2018-10-26/IMG_0053.jpeg)
[/photos]

[photos]
![](https://cdn.imalan.cn/img/post/2018-10-26/IMG_0039.jpeg)
![](https://cdn.imalan.cn/img/post/2018-10-26/IMG_0051.jpeg)
![](https://cdn.imalan.cn/img/post/2018-10-26/IMG_0005.jpeg)
[/photos]
```

在某些 Typecho 版本中 HTML 会被转义后输出，请使用 `!!!` 包裹以上代码，例如：

```
!!!
[photos]
···
[/photos]
!!!
```

`!!!` 需要单独占一行。

</details>

<details><summary>增强的 Markdown 语法</summary><br>

* 注音语法：`{{文本:zhu yin}}`，会渲染为：<ruby>文本<rp> (</rp><rt>zhu yin</rt><rp>)</rp></ruby>
* notice 提示块：`[notice]提示内容[/notice]`

</details>

<details><summary>页面空白</summary><br>

* 首先检查是否有插件重复引入了 JQuery，若有，在插件设置页面关闭。
* 另外，推荐使用 PHP 7.0 及以上版本搭配 MySQL 数据库。PHP 5.6 或者更低版本以及其它数据库可能出现未知问题（并且我不会去修复）。

</details>

## 更新

同[开始使用](#开始使用)，区别是你可以直接覆盖主题文件。大多数情况下无需禁用主题，这样你的主题设置就不会丢失。

某些版本由于改用幅度较大需要重启主题与插件，请参见对应版本的发布日志。

## 开发与自定义

**首先注意：我不保证提供任何自定义修改相关的指导与帮助。You are on your own.**

<details><summary>展开详情</summary><br>

如果你有不错的想法，可以定制自己的版本。首先你需要准备好 NodeJS 环境，然后 clone 这个 repo：

```bash
git clone https://github.com/Geek0ne/VOID-Plus ./VOID-Plus && cd ./VOID-Plus
```

安装依赖：

```bash
npm install -g gulp
npm install
```

用以下命令打包依赖的 JS 和 CSS：

```bash
gulp dev
```

主题的样式是用 SCSS 写的，你可以使用自己喜欢的方式编译 SCSS，或者使用：

```bash
gulp sass
```

监听 SCSS 更改然后实时编译。尽请添加自己想要的功能，满意后就提交代码。然后：

```bash
gulp build
```

构建你的主题，生成的主题位于 `./build` 目录下。如果你对自己的更改很满意，**欢迎提出 Pull Request**。

</details>

## 更新日志

**🍰 2026-10-30 Version 3.5.6（开发中）**

* 新增：页眉右上角新增昼夜模式切换按钮，可在后台模式之外手动切换深浅色
* 新增：后台新增备案号设置，页脚显示带国徽图标的备案号并链接至工信部查询
* 新增：页脚与文章末尾新增版权说明，含 CC 官方图标与许可协议链接，文章内附本文链接与引用提示
* 修复：归档页文章链接全部为空，页面中还会混入 PHP 警告文本
* 新增：代码块右上角显示语言标签与一键复制按钮，语法高亮扩充至 60+ 种语言
* 新增：文章未设置主图时自动回退使用主题默认头图
* 调整：移动端文章正文字号调小两号（18px → 16px）
* 调整：正文链接未访问显示蓝色、已访问显示紫色，暗色模式同步适配
* 调整：样式改动同步维护于 SCSS 源码与编译产物，gulp 构建不会丢失

**🍰 2026-10-29 Version 3.5.5**

修复与体验优化版本：

* 修复：首页刷新时闪现无样式页面（FOUC）
* 修复：右下角"回到顶部"按钮点击无反应
* 修复：文章目录高亮永远停在第一项、点击目录标题不跳转
* 调整：移除右下角齿轮设置面板与前台登录、后台入口等冗余项，仅保留回顶部与目录伸缩按钮

**🍰 2026-10-27 Version 3.5.4**

* 新增：发行包随附配套插件（`2.配套插件/VOIDPlus`）
* 新增：补回上游遗漏的 `OwO_02` 表情资源
* 调整：发行包结构与原版一致（`1.主题/VOID-Plus` + `2.配套插件/VOIDPlus`）

**🍰 2026-10-27 Version 3.5.3**

安全、兼容性与工程化维护版本，基于 3.5.1：

* 安全：新增 `Utils::esc()` 输出转义，头图/摘要等自定义字段全部转义后输出
* 安全：`brandFont` 限制为 http(s) 或站内相对 URL，数字字段强制整型
* 安全：随主题提供 `.htaccess`（安全响应头、目录保护、缓存与压缩）
* 兼容：适配 Typecho 1.3 / PHP 8.x
* 兼容：修复列表页永久链接计算触发的 Router 异常
* 兼容：修复 PHP 8 未定义键告警与评论链接错误
* 新增：`sitemap.php` 站点地图与 `robots.txt` 模板
* 优化：补全 SEO 标签（canonical、og:locale、og:image:alt 等）
* 修复：夜间模式切换时的首屏白屏闪烁
* 工程：前端构建产物纳入版本库，新增 CI 检查
* 调整：后台更新检查改用本仓库 Releases，版本号统一为 3.5.3

**🍰 2020-07-04 Version 3.5.1**

*该版本依赖 VOID-Plus 插件 1.20 及以上版本，请先禁用原插件，上传新插件后重新启用插件*

* 修复：iframe 尺寸错误（#42）
* 修复：归档页面显示未发布的文章（#45）

**🍰 2020-05-01 Version 3.5.0**

*该版本依赖 VOID-Plus 插件 1.20 及以上版本，请先禁用原插件，上传新插件后重新启用插件*

* 新增：[高级设置]图片懒加载渐变（需要 CDN 支持）
* 新增：JSON-LD 结构化数据支持
* 新增：重新设计的 404 页面
* 新增：[高级设置]站点标题设置自定义字体
* 优化：Bilibili 播放器自适应
* 优化：图题不再影响灯箱展开
* 调整：默认西文字体替换为 OpenSans
* 调整：简化头图设置
* 修复：某些情况下懒加载可能不触发的问题
* 修复：懒加载导致归档页面错乱
* 修复：Safari 平滑滚动无法打断, thank @Reedo0910
* 修复：[#32](https://github.com/AlanDecode/Typecho-Theme-VOID/issues/32)
* 修复：[#34](https://github.com/AlanDecode/Typecho-Theme-VOID/issues/34)
* 移除：Microdata
* 其它细节优化

从 2.2 版本起，主题部分功能需要配套插件支持，例如文章点赞、浏览量统计、字数统计等。**请先卸载**原来的 Likes、TePostViews 插件，否则数据会出现错误！TePostViews 插件卸载前请设置为**卸载后保留数据**，以防丢失浏览数据。

更多：[change-log.md](https://github.com/Geek0ne/VOID-Plus/blob/master/change-log.md)

## 鸣谢

### 开源项目

[JQuery](https://github.com/jquery/jquery) | [PrismJS](https://prismjs.com/index.html) | [MathJax](https://www.mathjax.org/) | [fancyBox](http://fancyapps.com/fancybox/3/) | [bigfoot.js](http://www.bigfootjs.com/) | [OwO](https://github.com/DIYgod/OwO) | [pjax](https://github.com/defunkt/jquery-pjax) | [yue.css](https://github.com/lepture/yue.css) | [tocbot](https://tscanlin.github.io/tocbot/) | [pangu.js](https://github.com/vinta/pangu.js) | [social](https://github.com/lepture/social) | [Headroom.js](http://wicky.nillia.ms/headroom.js/) | [hypher](https://github.com/bramstein/hypher)

### 其他

[RAW](https://github.com/AlanDecode/Typecho-Theme-RAW) | [Mirages](https://get233.com/archives/mirages-intro.html) | [handsome](https://www.ihewro.com/archives/489/) | [Card](https://blog.shuiba.co/bitcron-theme-card) | [Casper](https://github.com/TryGhost/Casper) | [Typlog](https://typlog.com/) | [FORMA](https://justgoodthemes.com/ghost-themes/forma/)

## License

MIT © [Geek0ne](https://github.com/Geek0ne)
