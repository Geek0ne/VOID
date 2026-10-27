/* eslint-disable linebreak-style */
/* eslint-disable no-undef */
if (document.getElementById('void-check-update')) {
    var container = document.getElementById('void-check-update');
    var ajax = new XMLHttpRequest();
    ajax.open('get', 'https://api.github.com/repos/Geek0ne/VOID/releases/latest');
    ajax.send();
    var parseVer = function (v) {
        return String(v).replace(/^v/i, '').split('.').map(function (n) {
            return parseInt(n, 10) || 0;
        });
    };
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var obj = JSON.parse(ajax.responseText);
            var newest = parseVer(obj.tag_name);
            var current = parseVer(VOIDVersion);
            var outdated = false;
            for (var i = 0; i < Math.max(newest.length, current.length); i++) {
                var n = newest[i] || 0;
                var c = current[i] || 0;
                if (n > c) {
                    outdated = true;
                    break;
                }
                if (n < c) {
                    break;
                }
            }
            if (outdated) {
                container.innerHTML =
                    '发现新主题版本：' + obj.name +
                    '。下载地址：<a href="' + obj.assets[0].browser_download_url + '">点击下载</a>' +
                    '<br>您目前的版本：VOID ' + String(VOIDVersion) + '。' +
                    '<a target="_blank" href="' + obj.html_url + '">👉查看新版亮点</a>';
            } else {
                container.innerHTML = '您目前使用的是最新版主题。';
            }
        }
    };
}
