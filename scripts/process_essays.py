import os
import markdown
import glob

MD_DIR = "essays/markdowns"
HTML_DIR = "essays/html"
INDEX_FILE = "essays/index.html"

os.makedirs(HTML_DIR, exist_ok=True)
os.makedirs(MD_DIR, exist_ok=True)

HTML_SKELETON = """<html>
<head>
    <title>{title}</title>
    <link rel="icon" href="../../content/favicon.png">
    <link rel="stylesheet" href="../../content/style.css">
</head>
<body>
    <main>
        <a href="../index.html">
            <header>
                <h1>Essays</h1>
            </header>
        </a>
        <h2>{title}</h2>
        {content}
    </main>
</body>
</html>"""

INDEX_SKELETON = """<html>
<head>
    <title>Essays</title>
    <link rel="icon" href="../content/favicon.png">
    <link rel="stylesheet" href="../content/style.css">
</head>
<body>
    <main>
        <a href="../index.html">
            <header>
                <h1>Essays</h1>
            </header>
        </a>
        <ul>
{links}
        </ul>
    </main>
</body>
</html>"""

md_files = glob.glob(os.path.join(MD_DIR, "*.md"))
links_html = ""

for md_path in md_files:
    filename = os.path.basename(md_path)
    name_no_ext = os.path.splitext(filename)[0]
    html_filename = f"{name_no_ext}.html"
    html_path = os.path.join(HTML_DIR, html_filename)
    
    with open(md_path, "r", encoding="utf-8") as f:
        md_text = f.read()
    
    html_content = markdown.markdown(md_text, extensions=['fenced_code', 'tables'])
    display_title = name_no_ext.replace("-", " ").title()

    full_html = HTML_SKELETON.format(title=display_title, content=html_content)
    with open(html_path, "w", encoding="utf-8") as f:
        f.write(full_html)
        
    links_html += f'            <li><a href="html/{html_filename}">{display_title}</a></li>\n'

index_html = INDEX_SKELETON.format(links=links_html)
with open(INDEX_FILE, "w", encoding="utf-8") as f:
    f.write(index_html)