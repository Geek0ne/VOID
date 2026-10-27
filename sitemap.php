<?php
/**
 * sitemap.php
 *
 * 生成 XML sitemap。两种使用方式:
 *   1. 直接访问 https://example.com/usr/themes/VOID/sitemap.php
 *      (需放行本文件的 PHP 执行,主题文档即为此设计)
 *   2. 在 __TYPECHO_ROOT_DIR__ 已定义的上下文中 include(如插件/路由引入)
 *
 * 支持查询参数:
 *   ?type=post  仅文章 | ?type=page  仅独立页面 | 默认全部
 *   ?days=30    仅输出最近 30 天修改过的内容
 *
 * 如需自定义 URL 前缀请修改下方站点地址的取值逻辑。
 */

if (!defined('__TYPECHO_ROOT_DIR__')) {
    // 独立访问模式: 引导 Typecho(本文件位于 ROOT/usr/themes/<主题目录>/)
    $voidSitemapRoot = dirname(__FILE__, 4);
    if (!is_file($voidSitemapRoot . '/config.inc.php')) {
        http_response_code(500);
        exit;
    }
    // config.inc.php 会定义 __TYPECHO_ROOT_DIR__ 并初始化 Db
    require_once $voidSitemapRoot . '/config.inc.php';
    // 独立模式下 Options 会按请求路径推算 rootUrl(会算错),
    // 这里用配置中的 siteUrl 固定,保证永久链接的域名/前缀正确
    define('__TYPECHO_ROOT_URL__', rtrim((string) \Utils\Helper::options()->siteUrl, '/') . '/');
    \Typecho\Router::setRoutes(\Utils\Helper::options()->routingTable);
}

use Typecho\Db;
use Typecho\Router;

$voidSitemapOptions = \Utils\Helper::options();
$voidSitemapDb = Db::get();
$voidSitemapSiteUrl = rtrim((string) $voidSitemapOptions->siteUrl, '/') . '/';

// 参数消毒
$voidSitemapType = isset($_GET['type']) ? (string) $_GET['type'] : 'all';
if (!in_array($voidSitemapType, ['post', 'page', 'all'], true)) {
    $voidSitemapType = 'all';
}
$voidSitemapDays = isset($_GET['days']) ? max(0, (int) $_GET['days']) : 0;

// 组装查询(仅已发布、已到创建时间的内容)
$voidSitemapSelect = $voidSitemapDb->select('cid', 'slug', 'type', 'modified')
    ->from('table.contents')
    ->where('status = ?', 'publish')
    ->where('created <= ?', $voidSitemapOptions->time);

if ('all' === $voidSitemapType) {
    $voidSitemapSelect->where('type = ? OR type = ?', 'post', 'page');
} else {
    $voidSitemapSelect->where('type = ?', $voidSitemapType);
}

if ($voidSitemapDays > 0) {
    $voidSitemapSelect->where('modified >= ?', $voidSitemapOptions->time - $voidSitemapDays * 86400);
}

$voidSitemapSelect->order('modified', Db::SORT_DESC)->limit(2000);
$voidSitemapRows = $voidSitemapDb->fetchAll($voidSitemapSelect);

// 站点内绝对地址基底(与核心 ___permalink 同算法)
$voidSitemapBase = \Utils\Helper::options()->index;

// 输出
header('Content-Type: application/xml; charset=UTF-8');
header('X-Robots-Tag: noindex', true);

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo htmlspecialchars($voidSitemapSiteUrl, ENT_XML1 | ENT_QUOTES, 'UTF-8'); ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
<?php foreach ($voidSitemapRows as $voidSitemapRow) {
    // 按路由表生成真实永久链接(文章/页面的链接结构不同)
    $voidSitemapLoc = \Typecho\Common::url(Router::url($voidSitemapRow['type'], $voidSitemapRow), $voidSitemapBase);
?>
    <url>
        <loc><?php echo htmlspecialchars($voidSitemapLoc, ENT_XML1 | ENT_QUOTES, 'UTF-8'); ?></loc>
        <lastmod><?php echo date('c', $voidSitemapRow['modified']); ?></lastmod>
        <changefreq><?php echo 'page' === $voidSitemapRow['type'] ? 'monthly' : 'weekly'; ?></changefreq>
        <priority><?php echo 'page' === $voidSitemapRow['type'] ? '0.6' : '0.8'; ?></priority>
    </url>
<?php } ?>
</urlset>
