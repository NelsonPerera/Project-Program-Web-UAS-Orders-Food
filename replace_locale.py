import os

def replace_in_file(file_path, old_str, new_str):
    try:
        with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
            content = f.read()
        if old_str in content:
            new_content = content.replace(old_str, new_str)
            with open(file_path, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print(f"Replaced in: {file_path}")
    except Exception as e:
        print(f"Error processing {file_path}: {e}")

start_dir = r'c:\xamppppp\htdocs\Food-order-website-master\public\assets'
old_text = 'Berhampur,Ganjam,Odisha'
new_text = 'Jakarta, Indonesia'

for root, dirs, files in os.walk(start_dir):
    for file in files:
        if file.endswith(('.html', '.js', '.php', '.css')):
            replace_in_file(os.path.join(root, file), old_text, new_text)
