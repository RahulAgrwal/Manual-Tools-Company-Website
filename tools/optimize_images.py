"""Create resized WebP copies of site images (next to the originals).

Pages call mtc_img() from image-helper.php, which serves the .webp copy when
it exists and falls back to the original otherwise. Originals are kept
because the brochure scripts use them.

Run from the repo root after adding or replacing images:
    python tools/optimize_images.py
"""
import os
from pathlib import Path

from PIL import Image

ROOT = Path("assets/img")
SOURCE_TYPES = {".jpg", ".jpeg", ".png"}
QUALITY = 80

# Longest side in pixels, by folder (first match wins).
MAX_SIDE = [
    ("slide-thumbnail", 480),  # blur-up placeholders and carousel thumbnails
    ("about-us-products-thumbnail", 800),
    ("clients", 400),
    ("", 1600),
]
SKIP_DIRS = {"slide-thumbnail-1"}  # unused

# Owned by tools/trim_cutouts.py, which trims the transparent margin off the
# product cutouts before encoding. Regenerating them here from the untrimmed
# PNG would silently undo that, so leave the folder alone.
TRIM_OWNED = ("slide/",)

# Folders whose photos also get a small "<name>.thumb.webp" for gallery strips.
THUMB_DIRS = ("product-images", "about-us-products/")
THUMB_SIDE = 320


def max_side_for(path):
    rel = path.relative_to(ROOT).as_posix()
    for prefix, size in MAX_SIDE:
        if rel.startswith(prefix):
            return size
    return 1600


def save_webp(src, dst, size):
    if dst.exists() and dst.stat().st_mtime >= src.stat().st_mtime:
        return False
    with Image.open(src) as im:
        im.load()
        has_alpha = im.mode in ("RGBA", "LA") or (im.mode == "P" and "transparency" in im.info)
        im = im.convert("RGBA" if has_alpha else "RGB")
        im.thumbnail((size, size), Image.LANCZOS)
        im.save(dst, "WEBP", quality=QUALITY, method=4)
    return True


def convert(src):
    rel = src.relative_to(ROOT).as_posix() + "/"
    if rel.startswith(THUMB_DIRS):
        save_webp(src, src.with_name(src.stem + ".thumb.webp"), THUMB_SIDE)
    dst = src.with_suffix(".webp")
    return dst if save_webp(src, dst, max_side_for(src)) else None


def main():
    before = after = 0
    for dirpath, dirnames, filenames in os.walk(ROOT):
        dirnames[:] = [d for d in dirnames if d not in SKIP_DIRS]
        for name in filenames:
            src = Path(dirpath) / name
            if src.suffix.lower() not in SOURCE_TYPES:
                continue
            if (src.relative_to(ROOT).as_posix() + "/").startswith(TRIM_OWNED):
                continue
            dst = convert(src)
            if dst:
                before += src.stat().st_size
                after += dst.stat().st_size
                print(f"{src} -> {dst.name}")
    if before:
        print(f"Converted {before / 1e6:.1f} MB -> {after / 1e6:.1f} MB")
    else:
        print("All WebP copies are up to date.")


if __name__ == "__main__":
    main()
