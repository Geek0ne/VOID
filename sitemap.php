<?php
/**
 * sitemap.php
 *
 * 生成 XML sitemap。两种使用方式:
 *   1. 直接访问 https://example.com/usr/themes/VOID-Plus/sitemap.php
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
    $voidPlusSitemapRoot = dirname(__FILE__, 4);
    if (!is_file($voidPlusSitemapRoot . '/config.inc.php')) {
        http_response_code(500);
        exit;
    }
    // config.inc.php 会定义 __TYPECHO_ROOT_DIR__ 并初始化 Db
    require_once $voidPlusSitemapRoot . '/config.inc.php';
    // 独立模式下 Options 会按请求路径推算 rootUrl(会算错),
    // 这里用配置中的 siteUrl 固定,保证永久链接的域名/前缀正确
    define('__TYPECHO_ROOT_URL__', rtrim((string) \Utils\Helper::options()->siteUrl, '/') . '/');
    \Typecho\Router::setRoutes(\Utils\Helper::options()->routingTable);
}

use Typecho\Db;
use Typecho\Router;

$voidPlusSitemapOptions = \Utils\Helper::options();
$voidPlusSitemapDb = Db::get();
$voidPlusSitemapSiteUrl = rtrim((string) $voidPlusSitemapOptions->siteUrl, '/') . '/';

// 参数消毒
$voidPlusSitemapType = isset($_GET['type']) ? (string) $_GET['type'] : 'all';
if (!in_array($voidPlusSitemapType, ['post', 'page', 'all'], true)) {
    $voidPlusSitemapType = 'all';
}
$voidPlusSitemapDays = isset($_GET['days']) ? max(0, (int) $_GET['days']) : 0;

// 组装查询(仅已发布、已到创建时间的内容)
$voidPlusSitemapSelect = $voidPlusSitemapDb->select('cid', 'slug', 'type', 'modified')
    ->from('table.contents')
    ->where('status = ?', 'publish')
    ->where('created <= ?', $voidPlusSitemapOptions->time);

if ('all' === $voidPlusSitemapType) {
    $voidPlusSitemapSelect->where('type = ? OR type = ?', 'post', 'page');
} else {
    $voidPlusSitemapSelect->where('type = ?', $voidPlusSitemapType);
}

if ($voidPlusSitemapDays > 0) {
    $voidPlusSitemapSelect->where('modified >= ?', $voidPlusSitemapOptions->time - $voidPlusSitemapDays * 86400);
}

$voidPlusSitemapSelect->order('modified', Db::SORT_DESC)->limit(2000);
$voidPlusSitemapRows = $voidPlusSitemapDb->fetchAll($voidPlusSitemapSelect);

// 站点内绝对地址基底(与核心 ___permalink 同算法)
$voidPlusSitemapBase = \Utils\Helper::options()->index;

// 输出
header('Content-Type: application/xml; charset=UTF-8');
header('X-Robots-Tag: noindex', true);

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo htmlspecialchars($voidPlusSitemapSiteUrl, ENT_XML1 | ENT_QUOTES, 'UTF-8'); ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
<?php foreach ($voidPlusSitemapRows as $voidPlusSitemapRow) {
    // 按路由表生成真实永久链接(文章/页面的链接结构不同)
    $voidPlusSitemapLoc = \Typecho\Common::url(Router::url($voidPlusSitemapRow['type'], $voidPlusSitemapRow), $voidPlusSitemapBase);
?>
    <url>
        <loc><?php echo htmlspecialchars($voidPlusSitemapLoc, ENT_XML1 | ENT_QUOTES, 'UTF-8'); ?></loc>
        <lastmod><?php echo date('c', $voidPlusSitemapRow['modified']); ?></lastmod>
        <changefreq><?php echo 'page' === $voidPlusSitemapRow['type'] ? 'monthly' : 'weekly'; ?></changefreq>
        <priority><?php echo 'page' === $voidPlusSitemapRow['type'] ? '0.6' : '0.8'; ?></priority>
    </url>
<?php } ?>
</urlset>
