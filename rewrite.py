import sys, re
msg = sys.stdin.read()
msg = re.sub(r'(?i)\bfixes\b', 'updates', msg)
msg = re.sub(r'(?i)\bfixed\b', 'updated', msg)
msg = re.sub(r'(?i)\bfix\b', 'update', msg)
msg = re.sub(r'(?i)\bresolves\b', 'addresses', msg)
msg = re.sub(r'(?i)\bresolved\b', 'addressed', msg)
msg = re.sub(r'(?i)\bresolve\b', 'address', msg)
sys.stdout.write(msg)
