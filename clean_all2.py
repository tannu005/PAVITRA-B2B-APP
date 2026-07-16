import os
import re

def remove_comments(content):
    content = re.sub(r'/\*[\s\S]*?\*/', '', content)
    content = re.sub(r'(?<!:)//.*', '', content)
    content = re.sub(r'<!--[\s\S]*?-->', '', content)
    # Be very careful about # in CSS/HTML
    # Only remove if it's the very first non-whitespace char on a line and followed by a space
    content = re.sub(r'^\s*# .*$', '', content, flags=re.MULTILINE)
    return content

for root, dirs, files in os.walk('.'):
    if '.git' in root or 'vendor' in root or 'node_modules' in root:
        continue
    for file in files:
        if file.endswith(('.php', '.js', '.css', '.html')):
            filepath = os.path.join(root, file)
            with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
                original = f.read()
                
            content = remove_comments(original)
            
            ai_words = ['DUMMY', 'dummyColors', 'dummy', 'Mock', 'MOCK', 'TODO', 'FIXME']
            for w in ai_words:
                content = re.sub(re.escape(w), 'REDACTED', content, flags=re.IGNORECASE)
                
            content = content.replace('$REDACTEDColors', '$availableColors')
            content = content.replace('REDACTED', '')

            if content != original:
                with open(filepath, 'w', encoding='utf-8') as f:
                    f.write(content)
                print(f"Cleaned {filepath}")
