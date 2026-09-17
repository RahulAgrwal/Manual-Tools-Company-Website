"""Tell Bing, Yandex and other IndexNow search engines that pages changed.

The key file (<key>.txt in the repo root) must be live on the site first,
so run this after the changes are deployed:
    python tools/indexnow_submit.py                  # every URL in sitemap.xml
    python tools/indexnow_submit.py /haulage /about  # only these paths

Google does not use IndexNow; use Search Console for Google.
"""
import json
import re
import sys
import urllib.request

HOST = "www.manualtoolsco.com"
KEY = "5980cefe6f533e8fca5d87e5d37f5339"


def sitemap_urls():
    with open("sitemap.xml", encoding="utf-8") as f:
        return re.findall(r"<loc>(.*?)</loc>", f.read())


def main():
    paths = sys.argv[1:]
    urls = [f"https://{HOST}/{p.lstrip('/')}" for p in paths] if paths else sitemap_urls()
    body = json.dumps({
        "host": HOST,
        "key": KEY,
        "keyLocation": f"https://{HOST}/{KEY}.txt",
        "urlList": urls,
    }).encode()
    req = urllib.request.Request(
        "https://api.indexnow.org/indexnow",
        data=body,
        headers={"Content-Type": "application/json; charset=utf-8"},
    )
    with urllib.request.urlopen(req) as resp:
        print(resp.status, f"submitted {len(urls)} URL(s)")


if __name__ == "__main__":
    main()
