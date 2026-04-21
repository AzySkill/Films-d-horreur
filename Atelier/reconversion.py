from pathlib import Path
import fitz  # PyMuPDF
from PIL import Image

input_pdf = Path("The horror vault.pdf")
output_png = Path("images/logo-horror-vault.png")

if not input_pdf.exists():
    raise FileNotFoundError(f"Input PDF not found: {input_pdf}")

output_png.parent.mkdir(parents=True, exist_ok=True)

with fitz.open(input_pdf) as pdf:
    if pdf.page_count < 1:
        raise ValueError("PDF ne contient aucune page")
    page = pdf[0]
    # alpha=True pour fond transparent
    pix = page.get_pixmap(alpha=True, dpi=300)

# Créer image PIL RGBA
img = Image.frombytes("RGBA", [pix.width, pix.height], pix.samples)

# Convertir les zones blanches en transparent
pixels = img.getdata()
new_pixels = []
for r, g, b, a in pixels:
    if a == 0:
        new_pixels.append((255, 255, 255, 0))
    elif r > 240 and g > 240 and b > 240:
        new_pixels.append((255, 255, 255, 0))
    else:
        new_pixels.append((r, g, b, a))
img.putdata(new_pixels)

# Recadrer sur la partie non transparente
bbox = img.getbbox()
if bbox:
    img = img.crop(bbox)

img.save(output_png, "PNG")
print(f"Converted {input_pdf} -> {output_png}")
