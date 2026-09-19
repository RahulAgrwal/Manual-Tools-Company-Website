"""Trim the transparent margin off the product cutouts in assets/img/slide/.

The cutouts are transparent PNGs of each machine, but the machine occupies as
little as 25% of its canvas (Power-Winch.png) -- the rest is empty alpha. Any
layout that sizes the image by its box therefore renders the machine at half
the size it could be, which is why the product cards and hero looked weak.

This writes only the .webp derivatives, never the .png. The brochure scripts
read the originals for cover art (see CLAUDE.md), and cutout_image() there
relies on the existing canvas, so the PNGs must stay exactly as they are.

    python tools/trim_cutouts.py            # regenerate what changed
    python tools/trim_cutouts.py --force    # regenerate everything
    python tools/trim_cutouts.py --report   # measure, write nothing

tools/optimize_images.py skips this folder (see TRIM_OWNED there), so the two
scripts do not fight over the same output files. Run this one first.
"""
import argparse
import sys
from pathlib import Path

from PIL import Image

SRC_DIR = Path("assets/img/slide")

# Keep a small margin so the machine never touches the edge of its container.
PAD_RATIO = 0.02          # of the longer trimmed side
ALPHA_FLOOR = 8           # alpha at or below this counts as empty
MAX_SIDE = 1600           # matches optimize_images.py for this folder
THUMB_SIDE = 480          # card wells are ~230 CSS px, so this covers 2x
QUALITY = 82

# Refuse a trim that keeps almost nothing: that means the alpha channel is not
# what we think it is, and a bad crop would ship a beheaded machine.
MIN_KEPT_AREA = 0.04


def content_box(im):
    """Bounding box of pixels above ALPHA_FLOOR, or None if the image is opaque."""
    if im.mode != "RGBA":
        return None
    alpha = im.getchannel("A")
    if alpha.getextrema()[0] > 250:       # fully opaque: not a cutout
        return None
    mask = alpha.point(lambda a: 255 if a > ALPHA_FLOOR else 0)
    return mask.getbbox()


def padded(box, size):
    l, t, r, b = box
    pad = int(round(max(r - l, b - t) * PAD_RATIO))
    return (max(0, l - pad), max(0, t - pad),
            min(size[0], r + pad), min(size[1], b + pad))


def save(im, dst, side):
    out = im.copy()
    out.thumbnail((side, side), Image.LANCZOS)
    out.save(dst, "WEBP", quality=QUALITY, method=6)
    return dst.stat().st_size


def main():
    ap = argparse.ArgumentParser(description=__doc__)
    ap.add_argument("--force", action="store_true", help="regenerate even if up to date")
    ap.add_argument("--report", action="store_true", help="measure only, write nothing")
    args = ap.parse_args()

    if not SRC_DIR.is_dir():
        sys.exit(f"{SRC_DIR} not found - run this from the repo root")

    before = after = 0
    skipped = []

    for src in sorted(SRC_DIR.glob("*.png")):
        webp = src.with_suffix(".webp")
        thumb = src.with_name(src.stem + ".thumb.webp")

        with Image.open(src) as im:
            im = im.convert("RGBA")
            full = im.size
            box = content_box(im)

            if box is None:
                skipped.append((src.name, "no alpha channel to trim"))
                continue

            kept = ((box[2] - box[0]) * (box[3] - box[1])) / (full[0] * full[1])
            if kept < MIN_KEPT_AREA:
                skipped.append((src.name, f"content is only {kept:.1%} of canvas"))
                continue

            crop = padded(box, full)
            fills_before = kept * 100
            fills_after = 100.0

            if args.report:
                print(f"{src.name:44} {full[0]}x{full[1]} -> "
                      f"{crop[2]-crop[0]}x{crop[3]-crop[1]}  "
                      f"fills {fills_before:.0f}% -> {fills_after:.0f}%")
                continue

            fresh = (webp.exists() and thumb.exists()
                     and webp.stat().st_mtime >= src.stat().st_mtime
                     and thumb.stat().st_mtime >= src.stat().st_mtime)
            if fresh and not args.force:
                continue

            old = webp.stat().st_size if webp.exists() else 0
            trimmed = im.crop(crop)
            new = save(trimmed, webp, MAX_SIDE)
            save(trimmed, thumb, THUMB_SIDE)

        before += old
        after += new
        print(f"{src.name:44} fills {fills_before:.0f}% -> 100%   "
              f"{old / 1024:.0f} KB -> {new / 1024:.0f} KB")

    for name, why in skipped:
        print(f"SKIP {name}: {why}")

    if not args.report:
        if before:
            print(f"\n{before / 1024:.0f} KB -> {after / 1024:.0f} KB across the full-size copies")
        else:
            print("All trimmed copies are up to date.")
    return 1 if skipped else 0


if __name__ == "__main__":
    sys.exit(main())
